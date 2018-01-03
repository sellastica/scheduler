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
	 * @param int $jobId
	 * @param int $projectId
	 * @param bool $success
	 * @return \DateTime|null
	 */
	public function getJobLastRunStart(int $jobId, int $projectId, bool $success = null): ?\DateTime
	{
		return $this->dao->getJobLastRunStart($jobId, $projectId, $success);
	}

	/**
	 * @param int $jobId
	 * @param int $projectId
	 * @return \DateTime|null
	 */
	public function getJobLastRunEnd(int $jobId, int $projectId): ?\DateTime
	{
		return $this->dao->getJobLastRunEnd($jobId, $projectId);
	}
}