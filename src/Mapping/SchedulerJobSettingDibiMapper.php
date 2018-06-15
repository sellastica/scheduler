<?php
namespace Sellastica\Scheduler\Mapping;

use Sellastica\Entity\Mapping\DibiMapper;

class SchedulerJobSettingDibiMapper extends DibiMapper
{
	use \Sellastica\DataGrid\Mapping\Dibi\TFilterRulesDibiMapper;


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
		return $this->database->select('s.id')
			->from($this->getTableName(true))->as('s')
			->innerJoin('%n.scheduler_project', $this->environment->getCrmDatabaseName())->as('sp')
			->on('sp.jobId = s.id')
			->where('s.active = 1')
			->where('sp.active = 1')
			->where('(sp.projectId = %i OR sp.projectId IS NULL)', $projectId)
			->orderBy('priority')
			->fetchPairs();
	}
}