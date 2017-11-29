<?php
namespace Sellastica\Scheduler\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;

/**
 * @method SchedulerLogRepository getRepository()
 */
class SchedulerLogRepositoryProxy extends RepositoryProxy implements \Sellastica\Scheduler\Entity\ISchedulerLogRepository
{
	public function getRunningProcessIds(\DateTime $dateTime): array
	{
		return $this->getRepository()->getRunningProcessIds($dateTime);
	}

	public function getLockingProcessId(int $jobId, int $excludedLogId)
	{
		return $this->getRepository()->getLockingProcessId($jobId, $excludedLogId);
	}

	public function clearOldLogEntries(\DateTime $endDate)
	{
		$this->getRepository()->clearOldLogEntries($endDate);
	}

	public function getJobLastRunDate(string $jobCode, bool $success = null)
	{
		return $this->getRepository()->getJobLastRunDate($jobCode, $success);
	}
}
