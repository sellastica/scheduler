<?php
namespace Sellastica\Scheduler\Mapping;

use Sellastica\Entity\Mapping\DibiMapper;
use Sellastica\Scheduler\Entity\SchedulerProject;

/**
 * @see SchedulerProject
 */
class SchedulerProjectDibiMapper extends DibiMapper
{
	/**
	 * @param int $jobId
	 * @return array
	 */
	public function findByJobId(int $jobId): array
	{
		return $this->getResourceWithIds()
			->leftJoin('%n.project', $this->environment->getCrmDatabaseName())
			->on('project.id = %n.projectId', $this->getTableName())
			->where('jobId = %i', $jobId)
			->orderBy('project.host')
			->fetchPairs();
	}

	/**
	 * @return bool
	 */
	protected function isInCrmDatabase(): bool
	{
		return true;
	}
}