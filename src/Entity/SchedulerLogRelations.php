<?php
namespace Sellastica\Scheduler\Entity;

class SchedulerLogRelations implements \Sellastica\Entity\Relation\IEntityRelations
{
	/** @var SchedulerLog */
	private $log;
	/** @var \Sellastica\Entity\EntityManager */
	private $em;


	/**
	 * @param SchedulerLog $log
	 * @param \Sellastica\Entity\EntityManager $em
	 */
	public function __construct(
		SchedulerLog $log,
		\Sellastica\Entity\EntityManager $em
	)
	{
		$this->log = $log;
		$this->em = $em;
	}

	/**
	 * @return \Sellastica\Project\Entity\Project
	 */
	public function getProject(): \Sellastica\Project\Entity\Project
	{
		return $this->em->getRepository(\Sellastica\Project\Entity\Project::class)->find($this->log->getProjectId());
	}
}