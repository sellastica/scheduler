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
			->leftJoin('crm.scheduler_job_setting')->as('s')
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
	 * @param string $jobCode
	 * @param bool $success
	 * @return \DateTime|null
	 */
	public function getJobLastRunDate($jobCode, $success = null)
	{
		$result = $this->database->select('MAX(start)')
			->from('crm.scheduler_job_setting s')
			->innerJoin($this->getTableName(true))->as('sl')
				->on('s.id = sl.jobId')
			->where('s.code = %s', $jobCode);

		if (!is_null($success)) {
			$result->where('sl.success = %i', $success);
		}

		$date = $result->fetchSingle();
		if ($date) {
			return new \DateTime($date);
		} else {
			return null;
		}
	}
}