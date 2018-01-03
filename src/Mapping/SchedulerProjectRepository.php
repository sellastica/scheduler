<?php
namespace Sellastica\Scheduler\Mapping;

use Sellastica\Entity\Mapping\Repository;
use Sellastica\Scheduler\Entity\SchedulerProject;
use Sellastica\Scheduler\Entity\ISchedulerProjectRepository;

/**
 * @property SchedulerProjectDao $dao
 * @see SchedulerProject
 */
class SchedulerProjectRepository extends Repository implements ISchedulerProjectRepository
{
}