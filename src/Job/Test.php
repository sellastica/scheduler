<?php
namespace Scheduler\Job;

class Test extends AbstractJob
{
	protected function run()
	{
		$this->log('This text is logged into the log and also is diplayed on the output in case of manual mode.');
	}
}