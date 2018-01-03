<?php
namespace Sellastica\Scheduler\Mapping;

use Sellastica\Entity\Mapping\DibiMapper;

class SchedulerLogDibiMapper extends DibiMapper
{
	/**
	 * @return bool
	 */
	protected function isInCrmDatabase(): bool
	{
		return true;
	}

	/**
	 * @param \DateTime $dateTime
	 * @return array
	 */
	public function getRunningProcessIds(\DateTime $dateTime)
	{
		$result = $this->database->select('sl.id')
			->from($this->getTableName(true))->as('sl')
			->leftJoin($this->environment->getCrmDatabaseName() . '.scheduler_job_setting')->as('s')
			->on('sl.jobId = s.id')
			->where('sl.start IS NOT null')
			->where('sl.end IS null')
			->where('UNIX_TIMESTAMP(sl.start) + s.maxExecutionTime < %i', $dateTime->getTimestamp())
			->fetchAll();

		return $this->getArray($result);
	}

	/**
	 * @param int $jobId
	 * @param int $excludedLogId
	 * @return int|false
	 */
	public function getLockingProcessId($jobId, $excludedLogId)
	{
		return $this->getResourceWithIds()
			->where('[end] IS null')
			->where('jobId = %i', $jobId)
			->where('id != %i', $excludedLogId)
			->fetchSingle();
	}

	/**
	 * @param \DateTime $endDate
	 * @return void
	 */
	public function clearOldLogEntries(\DateTime $endDate)
	{
		$this->database->delete($this->getTableName(true))
			->where('end < %s', $endDate->format('c'))
			->execute();
	}

	/**
	 * @param int $jobId
	 * @param int $projectId
	 * @param bool $success
	 * @return \DateTime|null
	 */
	public function getJobLastRunStart(int $jobId, int $projectId, $success = null): ?\DateTime
	{
		$result = $this->database->select('MAX(start)')
			->from($this->getTableName(true))
			->where('jobId = %i', $jobId)
			->where('projectId = %i', $projectId);

		if (!is_null($success)) {
			$result->where('sl.success = %i', $success);
		}

		$date = $result->fetchSingle();
		return $date
			? new \DateTime($date)
			: null;
	}

	/**
	 * @param int $jobId
	 * @param int $projectId
	 * @return \DateTime|null
	 */
	public function getJobLastRunEnd(int $jobId, int $projectId): ?\DateTime
	{
		$date = $this->database->select('[end]')
			->from($this->getTableName(true))
			->where('jobId = %i', $jobId)
			->where('projectId = %i', $projectId)
			->orderBy('id', \dibi::DESC)
			->fetchSingle();

		return $date
			? new \DateTime($date)
			: null;
	}
}