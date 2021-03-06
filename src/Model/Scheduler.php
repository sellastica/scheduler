<?php
namespace Sellastica\Scheduler\Model;

use Nette;
use Sellastica\Entity\EntityManager;
use Sellastica\Project\Model\ProjectAccessor;
use Sellastica\Scheduler\Entity\SchedulerJobSetting;
use Sellastica\Scheduler\Entity\SchedulerLog;

class Scheduler
{
	/** Older log entries after this time (in seconds) will be deleted */
	const SHEDULER_MAX_LOG_SECONDS = 7776000;

	const HOURLY = 3600,
		DAILY = 86400,
		WEEKLY = 604800;

	/** @var SchedulerJobSetting[] */
	private $queue = [];
	/** @var EntityManager */
	private $em;
	/** @var ProjectAccessor */
	private $projectAccessor;
	/** @var Nette\DI\Container */
	private $container;
	/** @var \Sellastica\Scheduler\Service\SchedulerService */
	private $schedulerService;


	/**
	 * @param EntityManager $em
	 * @param \Sellastica\Project\Model\ProjectAccessor $projectAccessor
	 * @param Nette\DI\Container $container
	 * @param \Sellastica\Scheduler\Service\SchedulerService $schedulerService
	 */
	public function __construct(
		EntityManager $em,
		ProjectAccessor $projectAccessor,
		Nette\DI\Container $container,
		\Sellastica\Scheduler\Service\SchedulerService $schedulerService
	)
	{
		$this->em = $em;
		$this->projectAccessor = $projectAccessor;
		$this->container = $container;
		$this->schedulerService = $schedulerService;
	}

	public function run()
	{
		$this->setJobsQueue();
		foreach ($this->queue as $job) {
			if ($this->schedulerService->hasJobToRun($job, $this->getProject())) {
				$this->runJob($job);
			}
		}
	}

	/**
	 * Make queue, list all enabled jobs and compute cron if run or not
	 */
	private function setJobsQueue(): void
	{
		$this->queue = $this->em->getRepository(SchedulerJobSetting::class)->findByProjectId(
			$this->getProject()->getId()
		);
	}

	/**
	 * @param SchedulerJobSetting $jobSetting
	 * @param bool $manual
	 * @return array Log messages
	 */
	public function runJob(SchedulerJobSetting $jobSetting, bool $manual = false): array
	{
		/** @var \Sellastica\Scheduler\Job\AbstractJob $job */
		$job = $this->container->getByType($jobSetting->getClassName());
		$job->setJobSetting($jobSetting);
		$job->setProject($this->getProject());
		$job->init($manual);

		return $job->getLogMessages();
	}

	public function clearOldLogEntries()
	{
		$endDate = new \DateTime(date('Y-m-d H:i:s', time() - self::SHEDULER_MAX_LOG_SECONDS));
		$this->em->getRepository(SchedulerLog::class)->clearOldLogEntries($endDate);
	}

	/**
	 * @return \Sellastica\Project\Entity\Project
	 */
	private function getProject(): \Sellastica\Project\Entity\Project
	{
		return $this->projectAccessor->get();
	}
}