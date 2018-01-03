<?php
namespace Sellastica\Scheduler\Mapping;

use Sellastica\Entity\Mapping\DibiMapper;
use Sellastica\Scheduler\Entity\SchedulerProject;

/**
 * @see SchedulerProject
 */
class SchedulerProjectDibiMapper extends DibiMapper
{
	/**
	 * @return bool
	 */
	protected function isInCrmDatabase(): bool
	{
		return true;
	}
}