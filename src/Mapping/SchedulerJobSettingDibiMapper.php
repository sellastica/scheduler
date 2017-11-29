<?php
namespace Sellastica\Scheduler\Mapping;

use Sellastica\Entity\Mapping\DibiMapper;

class SchedulerJobSettingDibiMapper extends DibiMapper
{
	/**
	 * @return bool
	 */
	protected function isInCrmDatabase(): bool
	{
		return true;
	}

	/**
	 * @param int $projectId
	 * @return array
	 */
	public function findByProjectId(int $projectId): array
	{
		$resource = $this->getResourceWithIds()
			->where('active = 1')
			->where('(projectId = %i OR projectId IS NULL)', $projectId)
			->orderBy('priority');
		return $this->getArray($resource->fetchAll());
	}
}