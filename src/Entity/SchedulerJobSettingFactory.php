<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\Entity\EntityFactory;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\EntityManager;
use Sellastica\Entity\Event\IDomainEventPublisher;
use Sellastica\Entity\IBuilder;
use Sellastica\Project\Entity\IProjectRepository;
use Sellastica\Project\Model\ProjectAccessor;

/**
 * @method SchedulerJobSetting build(IBuilder $builder, bool $initialize = true, int $assignedId = null)
 */
class SchedulerJobSettingFactory extends EntityFactory
{
	/** @var \Sellastica\Core\Model\Environment */
	private $environment;
	/** @var \Sellastica\Project\Entity\IProjectRepository */
	private $projectRepository;
	/** @var \Sellastica\Project\Model\ProjectAccessor */
	private $projectAccessor;


	/**
	 * @param \Sellastica\Entity\EntityManager $em
	 * @param IDomainEventPublisher $eventPublisher
	 * @param IProjectRepository $projectRepository
	 * @param \Sellastica\Project\Model\ProjectAccessor $projectAccessor
	 */
	public function __construct(
		EntityManager $em,
		IDomainEventPublisher $eventPublisher,
		IProjectRepository $projectRepository,
		ProjectAccessor $projectAccessor
	)
	{
		parent::__construct($em, $eventPublisher);

		$this->projectRepository = $projectRepository;
		$this->projectAccessor = $projectAccessor;
	}

	/**
	 * @param IEntity|SchedulerJobSetting $entity
	 */
	public function doInitialize(IEntity $entity)
	{
	}

	/**
	 * @return string
	 */
	public function getEntityClass(): string
	{
		return SchedulerJobSetting::class;
	}
}