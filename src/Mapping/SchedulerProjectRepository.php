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
	/**
	 * @param int $jobId
	 * @return \Sellastica\Scheduler\Entity\SchedulerProjectCollection
	 */
	public function findByJobId(int $jobId): \Sellastica\Scheduler\Entity\SchedulerProjectCollection
	{
		return $this->initialize(
			$this->dao->findByJobId($jobId)
		);
	}
}