<?php
namespace Sellastica\Scheduler\Mapping;

use Sellastica\Entity\Mapping\RepositoryProxy;
use Sellastica\Scheduler\Entity\SchedulerJobSettingCollection;

/**
 * @method SchedulerJobSettingRepository getRepository()
 */
class SchedulerJobSettingRepositoryProxy extends RepositoryProxy implements \Sellastica\Scheduler\Entity\ISchedulerJobSettingRepository
{
	public function findByProjectId(int $projectId): SchedulerJobSettingCollection
	{
		return $this->getRepository()->findByProjectId($projectId);
	}
}
