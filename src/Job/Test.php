<?php
namespace Sellastica\Scheduler\Job;

class Test extends AbstractJob
{
	/**
	 * @param bool $manual
	 */
	protected function run(bool $manual): void
	{
		$this->log('This text is logged into the log and also is diplayed on the output in case of manual mode.');
	}
}