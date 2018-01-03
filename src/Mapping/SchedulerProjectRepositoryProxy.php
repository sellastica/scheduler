<?php
namespace Sellastica\Scheduler\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;
use Sellastica\Scheduler\Entity\ISchedulerProjectRepository;
use Sellastica\Scheduler\Entity\SchedulerProject;

/**
 * @method SchedulerProjectRepository getRepository()
 * @see SchedulerProject
 */
class SchedulerProjectRepositoryProxy extends RepositoryProxy implements ISchedulerProjectRepository
{
}