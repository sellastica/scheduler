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
	/**
	 * @param int $jobId
	 * @return \Sellastica\Scheduler\Entity\SchedulerProjectCollection
	 */
	public function findByJobId(int $jobId): \Sellastica\Scheduler\Entity\SchedulerProjectCollection
	{
		return $this->getRepository()->findByJobId($jobId);
	}
}