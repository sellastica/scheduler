<?php
namespace Sellastica\Scheduler\Job;

use Sellastica\Entity\EntityManager;
use Sellastica\Project\Entity\Project;
use Sellastica\Scheduler\Entity\SchedulerJobSetting;
use Sellastica\Scheduler\Entity\SchedulerLog;
use Sellastica\Scheduler\Entity\SchedulerLogBuilder;

abstract class AbstractJob
{
	/** @var \Sellastica\Scheduler\Entity\SchedulerJobSetting */
	protected $jobSetting;
	/** @var \Sellastica\Entity\EntityManager */
	protected $em;
	/** @var \Sellastica\Project\Entity\Project */
	protected $project;
	/** @var array */
	private $logMessages = [];
	/** @var SchedulerLog */
	private $log;
	/** @var \Sellastica\Monolog\Logger */
	private $logger;


	/**
	 * @param \Sellastica\Entity\EntityManager $em
	 * @param \Sellastica\Monolog\Logger $logger
	 */
	public function __construct(
		EntityManager $em,
		\Sellastica\Monolog\Logger $logger
	)
	{
		$this->em = $em;
		$this->logger = $logger->channel('jobs');
	}

	/**
	 * @param SchedulerJobSetting $jobSetting
	 */
	public function setJobSetting(SchedulerJobSetting $jobSetting)
	{
		$this->jobSetting = $jobSetting;
	}

	/**
	 * @param Project $project
	 */
	public function setProject(Project $project)
	{
		$this->project = $project;
	}

	/**
	 * @param bool $manual
	 * @throws \Exception
	 */
	final public function init(bool $manual = false)
	{
		//insert record into the scheduler log
		$this->log = SchedulerLogBuilder::create($this->jobSetting->getId(), $this->project->getId(), $manual)
			->start(new \DateTime())
			->build();

		$this->em->persist($this->log);
		$this->em->flush();

		try {
			$this->run();
			$this->finish();
		} catch (\Throwable $e) {
			$this->logger->exception($e);
			$this->log($e->getMessage()); //log into the database
			$this->finish(false, $e);
		}
	}

	/**
	 * @param string $message
	 */
	protected function log(string $message)
	{
		$this->logMessages[] = $message;
	}

	/**
	 * @return array
	 */
	public function getLogMessages(): array
	{
		return $this->logMessages;
	}

	/**
	 * @param bool $success
	 * @param \Throwable $e
	 * @throws \Throwable
	 * @return void
	 */
	final public function finish($success = true, \Throwable $e = null)
	{
		//add info to log
		$this->log->setEnd(new \DateTime());
		$this->log->setSuccess($success);
		$this->log->setOutput(implode("\n", $this->logMessages));

		$this->em->persist($this->log);
		$this->em->flush();

		//add message for the output template
		$dateTime = new \DateTime();
		$this->log(sprintf('Job finished at %s', $dateTime->format('c')));

		//throw exception
		if ($e) {
			throw $e;
		}
	}

	/**
	 * @return void
	 */
	abstract protected function run();
}