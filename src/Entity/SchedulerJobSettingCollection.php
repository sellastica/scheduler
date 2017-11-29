<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\Entity\EntityCollection;

/**
 * @property SchedulerJobSetting[] $items
 * @method SchedulerJobSettingCollection add($entity)
 * @method SchedulerJobSettingCollection remove($key)
 * @method SchedulerJobSetting|mixed getEntity(int $entityId, $default = null)
 * @method SchedulerJobSetting|mixed getBy(string $property, $value, $default = null)
 */
class SchedulerJobSettingCollection extends EntityCollection
{
}