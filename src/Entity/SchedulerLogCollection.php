<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\Entity\EntityCollection;

/**
 * @property SchedulerLog[] $items
 * @method SchedulerLogCollection add($entity)
 * @method SchedulerLogCollection remove($key)
 * @method SchedulerLog|mixed getEntity(int $entityId, $default = null)
 * @method SchedulerLog|mixed getBy(string $property, $value, $default = null)
 */
class SchedulerLogCollection extends EntityCollection
{
}