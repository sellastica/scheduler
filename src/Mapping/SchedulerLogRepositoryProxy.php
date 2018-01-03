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

	public function getJobLastRunStart(int $jobId, int $projectId, bool $success = null): ?\DateTime
	{
		return $this->getRepository()->getJobLastRunStart($jobId, $projectId, $success);
	}

	public function getJobLastRunEnd(int $jobId, int $projectId): ?\DateTime
	{
		return $this->getRepository()->getJobLastRunEnd($jobId, $projectId);
	}
}
