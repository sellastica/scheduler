<?php
namespace Sellastica\Scheduler\Entity;

class SchedulerJobSettingRelations implements \Sellastica\Entity\Relation\IEntityRelations
{
	/** @var SchedulerJobSetting */
	private $jobSetting;
	/** @var \Sellastica\Entity\EntityManager */
	private $em;


	/**
	 * @param SchedulerJobSetting $jobSetting
	 * @param \Sellastica\Entity\EntityManager $em
	 */
	public function __construct(
		SchedulerJobSetting $jobSetting,
		\Sellastica\Entity\EntityManager $em
	)
	{
		$this->jobSetting = $jobSetting;
		$this->em = $em;
	}

	/**
	 * @return \Sellastica\Scheduler\Entity\SchedulerProjectCollection
	 */
	public function getProjects(): SchedulerProjectCollection
	{
		return $this->em->getRepository(SchedulerProject::class)->findByJobId($this->jobSetting->getId());
	}

	/**
	 * @param int|null $limit
	 * @return SchedulerLogCollection
	 */
	public function getLog(int $limit = null): SchedulerLogCollection
	{
		$configuration = \Sellastica\Entity\Configuration::sortBy('id', false);
		if (isset($limit)) {
			$configuration->setLimit($limit);
		}

		return $this->em->getRepository(SchedulerLog::class)->findBy([
			'jobId' => $this->jobSetting->getId(),
		], $configuration);
	}

	/**
	 * @return int
	 */
	public function getLogsCount(): int
	{
		return $this->em->getRepository(SchedulerLog::class)->findCountBy([
			'jobId' => $this->jobSetting->getId(),
		]);
	}
}