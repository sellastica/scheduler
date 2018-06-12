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
	 * @param string $jobClassName
	 * @param int $projectId
	 * @param int $period
	 * @param bool $active
	 * @throws \Exception
	 */
	public function addProject(
		string $jobClassName,
		int $projectId,
		int $period,
		bool $active = true
	): void
	{
		//find job by class name
		if (!$job = $this->findJobByClassName($jobClassName)) {
			throw new \Exception("Job $jobClassName does not exist");
		}

		//check if job is set for all projects already
		if ($this->isForAllProjects($job->getId())) {
			throw new \Exception("Cannot set job settings for project $projectId. This job is set for all projects already.");
		}

		//find or create project setting
		if (!$projectSetting = $this->em->getRepository(\Sellastica\Scheduler\Entity\SchedulerProject::class)->findOneBy([
			'jobId' => $job->getId(),
			'projectId' => $projectId,
		])) {
			$projectSetting = \Sellastica\Scheduler\Entity\SchedulerProjectBuilder::create($job->getId(), $period)
				->projectId($projectId)
				->build();
			$this->em->persist($projectSetting);
		}

		$projectSetting->setPeriod($period);
		$projectSetting->setActive($active);
	}

	/**
	 * @param string $jobClassName
	 * @param int $projectId
	 */
	public function removeProject(string $jobClassName, int $projectId): void
	{
		//find job by class name
		if (!$job = $this->findJobByClassName($jobClassName)) {
			throw new \Exception("Job $jobClassName does not exist");
		}

		//check if job is set for all projects
		if ($this->isForAllProjects($job->getId())) {
			throw new \Exception("Cannot remove job settings for project $projectId. This job is set for all projects.");
		}

		if ($projectSetting = $this->em->getRepository(\Sellastica\Scheduler\Entity\SchedulerProject::class)->findOneBy([
			'jobId' => $job->getId(),
			'projectId' => $projectId,
		])) {
			$this->em->remove($projectSetting);
		}
	}

	/**
	 * @param string $className
	 * @return \Sellastica\Scheduler\Entity\SchedulerJobSetting|null
	 */
	private function findJobByClassName(string $className): ?\Sellastica\Scheduler\Entity\SchedulerJobSetting
	{
		return $this->em->getRepository(\Sellastica\Scheduler\Entity\SchedulerJobSetting::class)->findOneBy([
			'className' => $className,
		]);
	}

	/**
	 * @param int $jobId
	 * @return bool
	 */
	private function isForAllProjects(int $jobId): bool
	{
		return $this->em->getRepository(\Sellastica\Scheduler\Entity\SchedulerProject::class)->existsBy([
			'jobId' => $jobId,
			'projectId IS NULL',
		]);
	}
}