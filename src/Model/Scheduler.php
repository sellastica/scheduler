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
			if ($this->hasJobToRun($job)) {
				$this->runJob($job);
			}
		}
	}

	/**
	 * Make queue, list all enabled jobs and compute cron if run or not
	 *
	 * @return void
	 */
	private function setJobsQueue()
	{
		$this->queue = $this->em->getRepository(SchedulerJobSetting::class)->findByProjectId(
			$this->projectAccessor->get()->getId()
		);
	}

	/**
	 * @param SchedulerJobSetting $jobSetting
	 * @return bool
	 * @throws \Exception
	 */
	private function hasJobToRun(SchedulerJobSetting $jobSetting)
	{
		$projectId = $this->projectAccessor->get()->getId();
		if (!$projectSettings = $this->schedulerService->getProjectSettings($jobSetting->getId(), $projectId)) {
			return false;
		}

		$lastRunStart = $this->schedulerService->getLastRunStart($jobSetting->getId(), $projectId);
		$lastRunEnd = $this->schedulerService->getLastRunEnd($jobSetting->getId(), $projectId);

		if (!$lastRunStart) { //never ran before
			return true;
		} elseif (!$lastRunEnd) {
			//end timestamp may not be logged because of some server error
			//in that case, we cannot disable jobs for ever!
			//so, we run all jobs with last start older than one day
			$lastStart = clone $lastRunStart;
			//add one day interval
			$lastStart->add(new \DateInterval('P1D'));
			if ($lastStart < new \DateTime('now')) { //if last start was earlier then before one day
				return true;
			} else {
				return false;
			}
		}

		return $lastRunEnd->getTimestamp()
			+ $projectSettings->getPeriod() <= time();
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
		$job->setProject($this->projectAccessor->get());
		$job->init($manual);

		return $job->getLogMessages();
	}

	public function clearOldLogEntries()
	{
		$endDate = new \DateTime(date('Y-m-d H:i:s', time() - self::SHEDULER_MAX_LOG_SECONDS));
		$this->em->getRepository(SchedulerLog::class)->clearOldLogEntries($endDate);
	}
}