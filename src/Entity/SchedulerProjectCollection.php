<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\Entity\EntityCollection;

/**
 * @property SchedulerProject[] $items
 * @method SchedulerProjectCollection add($entity)
 * @method SchedulerProjectCollection remove($key)
 * @method SchedulerProject|mixed getEntity(int $entityId, $default = null)
 * @method SchedulerProject|mixed getBy(string $property, $value, $default = null)
 */
class SchedulerProjectCollection extends EntityCollection
{
}