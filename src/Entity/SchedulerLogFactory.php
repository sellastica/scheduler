<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\Entity\EntityFactory;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\IBuilder;

/**
 * @method SchedulerLog build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 */
class SchedulerLogFactory extends EntityFactory
{
	/**
	 * @param \Sellastica\Entity\Entity\IEntity $entity
	 */
	public function doInitialize(IEntity $entity)
	{
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return SchedulerLog::class;
	}
}