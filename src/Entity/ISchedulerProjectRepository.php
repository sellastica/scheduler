<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method SchedulerProject find(int $id)
 * @method SchedulerProject findOneBy(array $filterValues)
 * @method SchedulerProject findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method SchedulerProject[]|SchedulerProjectCollection findAll(Configuration $configuration = null)
 * @method SchedulerProject[]|SchedulerProjectCollection findBy(array $filterValues, Configuration $configuration = null)
 * @method SchedulerProject[]|SchedulerProjectCollection findByIds(array $idsArray, Configuration $configuration = null)
 * @method SchedulerProject[]|SchedulerProjectCollection findPublishable(int $id)
 * @method SchedulerProject[]|SchedulerProjectCollection findAllPublishable(Configuration $configuration = null)
 * @method SchedulerProject[]|SchedulerProjectCollection findPublishableBy(array $filterValues, Configuration $configuration = null)
 * @see SchedulerProject
 */
interface ISchedulerProjectRepository extends IRepository
{
}