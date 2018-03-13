<?php
namespace Sellastica\Scheduler\Mapping;

use Sellastica\Entity\Entity\EntityCollection;
use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Mapping\Dao;
use Sellastica\Scheduler\Entity\SchedulerLogBuilder;
use Sellastica\Scheduler\Entity\SchedulerLogCollection;

/**
 * @property SchedulerLogDibiMapper $mapper
 */
class SchedulerLogDao extends Dao
{
	/**
	 * @param \DateTime $dateTime
	 * @return array
	 */
	public function getRunningProcessIds(\DateTime $dateTime)
	{
		return $this->mapper->getRunningProcessIds($dateTime);
	}

	/**
	 * @param int $jobId
	 * @param int $excludedLogId
	 * @return int|false
	 */
	public function getLockingProcessId($jobId, $excludedLogId)
	{
		return $this->mapper->getLockingProcessId($jobId, $excludedLogId);
	}

	/**
	 * @param \DateTime $dateTime
	 * @return void
	 */
	public function clearOldLogEntries(\DateTime $dateTime)
	{
		$this->mapper->clearOldLogEntries($dateTime);
	}

	/**
	 * @param int $jobId
	 * @param int $projectId
	 * @param bool $success
	 * @return \DateTime|null
	 */
	public function getJobLastRunStart(int $jobId, int $projectId, $success = null): ?\DateTime
	{
		return $this->mapper->getJobLastRunStart($jobId, $projectId, $success);
	}

	/**
	 * @param int $jobId
	 * @param int $projectId
	 * @return \DateTime|null
	 */
	public function getJobLastRunEnd(int $jobId, int $projectId): ?\DateTime
	{
		return $this->mapper->getJobLastRunEnd($jobId, $projectId);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getBuilder($data, $first = null, $second = null): IBuilder
	{
		return SchedulerLogBuilder::create($data->jobId, $data->projectId, $data->manual)
			->hydrate($data);
	}

	/**
	 * @return EntityCollection|\Sellastica\Scheduler\Entity\SchedulerLogCollection
	 */
	public function getEmptyCollection(): EntityCollection
	{
		return new SchedulerLogCollection();
	}
}