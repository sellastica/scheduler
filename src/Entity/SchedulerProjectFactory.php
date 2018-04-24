<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\Entity\EntityFactory;

/**
 * @method SchedulerProject build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 * @see SchedulerProject
 */
class SchedulerProjectFactory extends EntityFactory
{
	/**
	 * @param IEntity|SchedulerProject $entity
	 */
	public function doInitialize(IEntity $entity)
	{
		$entity->setRelationService(new SchedulerProjectRelations($entity, $this->em));
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return SchedulerProject::class;
	}
}