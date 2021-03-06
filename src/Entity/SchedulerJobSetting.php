<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\Entity\AbstractEntity;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\Entity\TAbstractEntity;

/**
 * @generate-builder
 * @see SchedulerJobSettingBuilder
 *
 * @property \Sellastica\Scheduler\Entity\SchedulerJobSettingRelations $relationService
 */
class SchedulerJobSetting extends AbstractEntity implements IEntity
{
	use TAbstractEntity;

	/** @var string @required */
	private $className;
	/** @var int|null @optional */
	private $priority;
	/** @var bool @optional */
	private $manual = true;
	/** @var bool @optional */
	private $active = false;


	/**
	 * @param SchedulerJobSettingBuilder $builder
	 */
	public function __construct(SchedulerJobSettingBuilder $builder)
	{
		$this->hydrate($builder);
	}

	/**
	 * @return bool
	 */
	public static function isIdGeneratedByStorage(): bool
	{
		return true;
	}

	/**
	 * @return string
	 */
	public function getClassName(): string
	{
		return $this->className;
	}

	/**
	 * @param string $className
	 */
	public function setClassName(string $className)
	{
		$this->className = $className;
	}

	/**
	 * @return bool
	 */
	public function getManual(): bool
	{
		return $this->manual;
	}

	/**
	 * @param bool $manual
	 */
	public function setManual(bool $manual)
	{
		$this->manual = $manual;
	}

	/**
	 * @return bool
	 */
	public function getActive(): bool
	{
		return $this->active;
	}

	/**
	 * @param bool $active
	 */
	public function setActive(bool $active)
	{
		$this->active = $active;
	}

	/**
	 * @return int|null
	 */
	public function getPriority(): ?int
	{
		return $this->priority;
	}

	/**
	 * @param int|null $priority
	 */
	public function setPriority(?int $priority)
	{
		$this->priority = $priority;
	}

	/**
	 * @param int|null $limit
	 * @return SchedulerLogCollection
	 */
	public function getLog(int $limit = null): SchedulerLogCollection
	{
		return $this->relationService->getLog($limit);
	}

	/**
	 * @return int
	 */
	public function getLogsCount(): int
	{
		return $this->relationService->getLogsCount();
	}

	/**
	 * @return \Sellastica\Scheduler\Entity\SchedulerProjectCollection
	 */
	public function getProjects(): SchedulerProjectCollection
	{
		return $this->relationService->getProjects();
	}
	
	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'className' => $this->className,
			'priority' => $this->priority,
			'manual' => $this->manual,
			'active' => $this->active,
		];
	}
}