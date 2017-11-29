<?php
namespace Sellastica\Scheduler\Job;

use Scheduler\Job\AbstractJob;

class Test extends AbstractJob
{
	protected function run()
	{
		$this->log('This text is logged into the log and also is diplayed on the output in case of manual mode.');
	}
}