<?php
namespace App\UI\Presenters;

use Sellastica\Scheduler\Entity\SchedulerJobSetting;
use Sellastica\Scheduler\Model\Scheduler;

class SchedulerPresenter extends BasePresenter
{
	use TSuperUser;

	/** @var Scheduler @inject */
	public $scheduler;
	/** @var \Sellastica\Scheduler\Entity\ISchedulerJobSettingRepository @inject */
	public $schedulerJobSettingRepository;


	public function startup()
	{
		parent::startup();
	}

	/**
	 * @param int $id
	 * @throws \Nette\Application\BadRequestException
	 */
	public function actionJobs(int $id = null)
	{
		if (!isset($id)) {
			$this->scheduler->clearOldLogEntries();
			$this->scheduler->run();
			die('OK');
		} else {
			$this->runManualJob($id);
		}
	}

	/**
	 * @param int $id
	 */
	private function runManualJob(int $id)
	{
		/** @var SchedulerJobSetting $jobSetting */
		if (!$jobSetting = $this->entityManager->getRepository(SchedulerJobSetting::class)->find($id)) {
			$this->error404('Job not found');
		} elseif (!$jobSetting->getManual()) {
			$this->error403('This job cannot be started manually');
		}

		$this->scheduler->clearOldLogEntries();
		$this->template->logMessages = $this->scheduler->runJob($jobSetting, true);
		$this->setView('job');
	}
}
