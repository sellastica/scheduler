<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\Entity\AbstractEntity;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\Entity\TAbstractEntity;

/**
 * @generate-builder
 * @see SchedulerJobSettingBuilder
 */
class SchedulerJobSetting extends AbstractEntity implements IEntity
{
	use TAbstractEntity;

	/** @var string @required */
	private $className;
	/** @var int|null @optional */
	private $projectId;
	/** @var int @required */
	private $period;
	/** @var \DateTime|null @optional Last job run start */
	private $lastRun;
	/** @var \DateTime|null @optional Last job run end */
	private $lastRunEnd;
	/** @var string|null @optional */
	private $params;
	/** @var bool @optional */
	private $manual = true;
	/** @var bool @optional */
	private $active = false;
	/** @var int|null @optional */
	private $priority;


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
	 * @return int|null
	 */
	public function getProjectId(): ?int
	{
		return $this->projectId;
	}

	/**
	 * @param int|null $projectId
	 */
	public function setProjectId(?int $projectId)
	{
		$this->projectId = $projectId;
	}

	/**
	 * @return int
	 */
	public function getPeriod(): int
	{
		return $this->period;
	}

	/**
	 * @param int $period
	 */
	public function setPeriod(int $period)
	{
		$this->period = $period;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getLastRunStart(): ?\DateTime
	{
		return $this->lastRun;
	}

	/**
	 * @param \DateTime|null $lastRun
	 */
	public function setLastRun(?\DateTime $lastRun)
	{
		$this->lastRun = $lastRun;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getLastRunEnd(): ?\DateTime
	{
		return $this->lastRunEnd;
	}

	/**
	 * @param \DateTime|null $lastRunEnd
	 */
	public function setLastRunEnd(?\DateTime $lastRunEnd)
	{
		$this->lastRunEnd = $lastRunEnd;
	}

	/**
	 * @return null|string
	 */
	public function getParams(): ?string
	{
		return $this->params;
	}

	/**
	 * @param null|string $params
	 */
	public function setParams(?string $params)
	{
		$this->params = $params;
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
	 * @return array
	 */
	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'projectId' => $this->projectId,
			'className' => $this->className,
			'period' => $this->period,
			'lastRun' => $this->lastRun,
			'lastRunEnd' => $this->lastRunEnd,
			'params' => $this->params,
			'priority' => $this->priority,
			'manual' => $this->manual,
			'active' => $this->active,
		];
	}
}