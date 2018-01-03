<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\Configuration;
use Sellastica\Entity\Mapping\IRepository;

/**
 * @method SchedulerLog find(int $id)
 * @method SchedulerLog findOneBy(array $filterValues)
 * @method SchedulerLog[] findAll(Configuration $configuration = null)
 * @method SchedulerLog[] findBy(array $filterValues, Configuration $configuration = null)
 * @method SchedulerLog[] findByIds(array $idsArray, Configuration $configuration = null)
 * @method SchedulerLog findPublishable(int $id)
 * @method SchedulerLog findOnePublishableBy(array $filterValues, Configuration $configuration = null)
 * @method SchedulerLog[] findAllPublishable(Configuration $configuration = null)
 * @method SchedulerLog[] findPublishableBy(array $filterValues, Configuration $configuration = null)
 */
interface ISchedulerLogRepository extends IRepository
{
	/**
	 * @param \DateTime $dateTime
	 * @return array
	 */
	function getRunningProcessIds(\DateTime $dateTime): array;

	/**
	 * @param int $jobId
	 * @param int $excludedLogId
	 * @return int
	 */
	function getLockingProcessId(int $jobId, int $excludedLogId);

	/**
	 * @param \DateTime $endDate
	 * @return void
	 */
	function clearOldLogEntries(\DateTime $endDate);

	/**
	 * @param int $jobId
	 * @param int $projectId
	 * @param bool $success
	 * @return \DateTime|null
	 */
	function getJobLastRunStart(int $jobId, int $projectId, bool $success = null): ?\DateTime;

	/**
	 * @param int $jobId
	 * @param int $projectId
	 * @return \DateTime|null
	 */
	function getJobLastRunEnd(int $jobId, int $projectId): ?\DateTime;
}
