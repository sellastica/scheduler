<?php
namespace Sellastica\Scheduler\Mapping;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Mapping\Dao;
use Sellastica\Scheduler\Entity\SchedulerProject;
use Sellastica\Scheduler\Entity\SchedulerProjectBuilder;
use Sellastica\Entity\Entity\EntityCollection;
use Sellastica\Scheduler\Entity\SchedulerProjectCollection;

/**
 * @see SchedulerProject
 * @property SchedulerProjectDibiMapper $mapper
 */
class SchedulerProjectDao extends Dao
{
	/**
	 * @inheritDoc
	 */
	protected function getBuilder(
		$data,
		$first = null,
		$second = null
	): IBuilder
	{
		return SchedulerProjectBuilder::create($data->jobId, $data->period)
			->hydrate($data);
	}

	/**
	 * @param int $jobId
	 * @return SchedulerProjectCollection
	 */
	public function findByJobId(int $jobId): SchedulerProjectCollection
	{
		return $this->getEntitiesFromCacheOrStorage(
			$this->mapper->findByJobId($jobId)
		);
	}

	/**
	 * @return EntityCollection|SchedulerProjectCollection
	 */
	public function getEmptyCollection(): EntityCollection
	{
		return new SchedulerProjectCollection;
	}
}