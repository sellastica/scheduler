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
}