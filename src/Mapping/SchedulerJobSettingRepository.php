<?php
namespace Sellastica\Scheduler\Mapping;

use Sellastica\Entity\Mapping\Repository;
use Sellastica\Scheduler\Entity\ISchedulerJobSettingRepository;
use Sellastica\Scheduler\Entity\SchedulerJobSettingCollection;

/**
 * @property SchedulerJobSettingDao $dao
 */
class SchedulerJobSettingRepository extends Repository implements ISchedulerJobSettingRepository
{
	use \Sellastica\DataGrid\Mapping\Dibi\TFilterRulesRepository;


	/**
	 * @param int $projectId
	 * @return SchedulerJobSettingCollection
	 */
	public function findByProjectId(int $projectId): \Sellastica\Scheduler\Entity\SchedulerJobSettingCollection
	{
		return $this->initialize($this->dao->findByProjectId($projectId));
	}
}