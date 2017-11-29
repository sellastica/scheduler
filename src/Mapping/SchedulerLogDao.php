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
	 * @param string $jobCode
	 * @param bool $success
	 * @return \DateTime|null
	 */
	public function getJobLastRunDate($jobCode, $success = null)
	{
		return $this->mapper->getJobLastRunDate($jobCode, $success);
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getBuilder($data, $first = null, $second = null): IBuilder
	{
		return SchedulerLogBuilder::create($data->manual)
			->hydrate($data);
	}

	/**
	 * @return EntityCollection|\Sellastica\Scheduler\Entity\SchedulerLogCollection
	 */
	protected function getEmptyCollection(): EntityCollection
	{
		return new SchedulerLogCollection();
	}
}