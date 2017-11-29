<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method SchedulerJobSetting find(int $id)
 * @method SchedulerJobSetting findOneBy(array $filterValues)
 * @method SchedulerJobSetting[] findAll(Configuration $configuration = null)
 * @method SchedulerJobSetting[] findBy(array $filterValues, Configuration $configuration = null)
 * @method SchedulerJobSetting[] findByIds(array $idsArray, Configuration $configuration = null)
 * @method SchedulerJobSetting findPublishable(int $id)
 * @method SchedulerJobSetting findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method SchedulerJobSetting[] findAllPublishable(Configuration $configuration = null)
 * @method SchedulerJobSetting[] findPublishableBy(array $filterValues, Configuration $configuration = null)
 */
interface ISchedulerJobSettingRepository extends IRepository
{
	/**
	 * @param int $projectId
	 * @return SchedulerJobSettingCollection
	 */
	function findByProjectId(int $projectId): SchedulerJobSettingCollection;
}
