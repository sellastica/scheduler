<?php
namespace Sellastica\Scheduler\Service;

class SchedulerService
{
	/** @var \Sellastica\Entity\EntityManager */
	private $em;


	/**
	 * @param \Sellastica\Entity\EntityManager $em
	 */
	public function __construct(
		\Sellastica\Entity\EntityManager $em
	)
	{
		$this->em = $em;
	}

	/**
	 * @param int $jobId
	 * @param int $projectId
	 * @return \DateTime|null
	 */
	public function getLastRunStart(int $jobId, int $projectId): ?\DateTime
	{
		return $this->em->getRepository(\Sellastica\Scheduler\Entity\SchedulerLog::class)
			->getJobLastRunStart($jobId, $projectId);
	}

	/**
	 * @param int $jobId
	 * @param int $projectId
	 * @return \DateTime|null
	 */
	public function getLastRunEnd(int $jobId, int $projectId): ?\DateTime
	{
		return $this->em->getRepository(\Sellastica\Scheduler\Entity\SchedulerLog::class)
			->getJobLastRunEnd($jobId, $projectId);
	}

	/**
	 * @param int $jobId
	 * @param int $projectId
	 * @return \Sellastica\Scheduler\Entity\SchedulerProject|\Sellastica\Entity\Entity\IEntity|null
	 */
	public function getProjectSettings(int $jobId, int $projectId): ?\Sellastica\Scheduler\Entity\SchedulerProject
	{
		return $this->em->getRepository(\Sellastica\Scheduler\Entity\SchedulerProject::class)->findOneBy([
			'jobId' => $jobId,
			sprintf('projectId = %s OR projectId IS NULL', $projectId),
		]);
	}

	/**
	 * @param int $jobId
	 * @param int $projectId
	 * @param int $period
	 * @param bool $active
	 */
	public function setProjectSettings(
		int $jobId,
		int $projectId,
		int $period,
		bool $active = true
	): void
	{
		if ($this->em->getRepository(\Sellastica\Scheduler\Entity\SchedulerProject::class)->findOneBy([
			'jobId' => $jobId,
			'projectId IS NULL',
		])) {
			throw new \Exception("Cannot set job settings for project $projectId. This job is set for all projects already.");
		}

		if (!$projectSetting = $this->em->getRepository(\Sellastica\Scheduler\Entity\SchedulerProject::class)->findOneBy([
			'jobId' => $jobId,
			'projectId' => $projectId,
		])) {
			$projectSetting = \Sellastica\Scheduler\Entity\SchedulerProjectBuilder::create($jobId, $period)
				->projectId($projectId)
				->build();
			$this->em->persist($projectSetting);
		}

		$projectSetting->setPeriod($period);
		$projectSetting->setActive($active);
	}

	/**
	 * @param int $jobId
	 * @param int $projectId
	 */
	public function removeProjectSettings(int $jobId, int $projectId): void
	{
		if ($projectSetting = $this->em->getRepository(\Sellastica\Scheduler\Entity\SchedulerProject::class)->findOneBy([
			'jobId' => $jobId,
			'projectId' => $projectId,
		])) {
			$this->em->remove($projectSetting);
		}
	}
}