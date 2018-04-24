<?php
namespace Sellastica\Scheduler\Mapping;

use Sellastica\Entity\Entity\EntityCollection;
use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Mapping\Dao;
use Sellastica\Scheduler\Entity\SchedulerJobSettingBuilder;
use Sellastica\Scheduler\Entity\SchedulerJobSettingCollection;

/**
 * @property SchedulerJobSettingDibiMapper $mapper
 */
class SchedulerJobSettingDao extends Dao
{
	/**
	 * @param int $projectId
	 * @return \Sellastica\Scheduler\Entity\SchedulerJobSettingCollection
	 */
	public function findByProjectId(int $projectId): \Sellastica\Scheduler\Entity\SchedulerJobSettingCollection
	{
		return $this->getEntitiesFromCacheOrStorage($this->mapper->findByProjectId($projectId));
	}

	/**
	 * {@inheritdoc}
	 */
	protected function getBuilder($data, $first = null, $second = null): IBuilder
	{
		return SchedulerJobSettingBuilder::create($data->className)
			->hydrate($data);
	}

	/**
	 * @return EntityCollection|\Sellastica\Scheduler\Entity\SchedulerJobSettingCollection
	 */
	public function getEmptyCollection(): EntityCollection
	{
		return new \Sellastica\Scheduler\Entity\SchedulerJobSettingCollection();
	}
}