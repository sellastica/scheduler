<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\Entity\EntityFactory;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\IBuilder;

/**
 * @method SchedulerJobSetting build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 */
class SchedulerJobSettingFactory extends EntityFactory
{
	/**
	 * @param IEntity|SchedulerJobSetting $entity
	 */
	public function doInitialize(IEntity $entity)
	{
		$entity->setRelationService(new SchedulerJobSettingRelations($entity, $this->em));
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return SchedulerJobSetting::class;
	}
}