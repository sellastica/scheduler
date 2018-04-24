<?php
namespace Sellastica\Scheduler\Entity;

class SchedulerProjectRelations implements \Sellastica\Entity\Relation\IEntityRelations
{
	/** @var SchedulerProject */
	private $schedulerProject;
	/** @var \Sellastica\Entity\EntityManager */
	private $em;


	/**
	 * @param SchedulerProject $schedulerProject
	 * @param \Sellastica\Entity\EntityManager $em
	 */
	public function __construct(
		SchedulerProject $schedulerProject,
		\Sellastica\Entity\EntityManager $em
	)
	{
		$this->schedulerProject = $schedulerProject;
		$this->em = $em;
	}

	/**
	 * @return \Sellastica\Project\Entity\Project|null
	 */
	public function getProject(): ?\Sellastica\Project\Entity\Project
	{
		return $this->em->getRepository(\Sellastica\Project\Entity\Project::class)
			->find($this->schedulerProject->getProjectId());
	}
}