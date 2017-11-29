<?php
namespace Sellastica\Scheduler\Mapping;

use Sellastica\Entity\Mapping\Repository;
use Sellastica\Scheduler\Entity\ISchedulerLogRepository;

/**
 * @property SchedulerLogDao $dao
 */
class SchedulerLogRepository extends Repository implements ISchedulerLogRepository
{
	/**
	 * @param \DateTime $dateTime
	 * @return array
	 */
	public function getRunningProcessIds(\DateTime $dateTime): array
	{
		return $this->dao->getRunningProcessIds($dateTime);
	}

	/**
	 * @param int $jobId
	 * @param int $excludedLogId
	 * @return int
	 */
	public function getLockingProcessId(int $jobId, int $excludedLogId)
	{
		return $this->dao->getLockingProcessId($jobId, $excludedLogId);
	}

	/**
	 * @param \DateTime $endDate
	 * @return void
	 */
	public function clearOldLogEntries(\DateTime $endDate)
	{
		$this->dao->clearOldLogEntries($endDate);
	}

	/**
	 * @param string $jobCode
	 * @param bool $success
	 * @return \DateTime|null
	 */
	public function getJobLastRunDate(string $jobCode, bool $success = null)
	{
		return $this->dao->getJobLastRunDate($jobCode, $success);
	}
}