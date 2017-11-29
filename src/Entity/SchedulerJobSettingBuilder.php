<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\TBuilder;

/**
 * @see SchedulerJobSetting
 */
class SchedulerJobSettingBuilder implements IBuilder
{
	use TBuilder;

	/** @var string */
	private $className;
	/** @var int */
	private $period;
	/** @var int|null */
	private $projectId;
	/** @var \DateTime|null */
	private $lastRun;
	/** @var \DateTime|null */
	private $lastRunEnd;
	/** @var string|null */
	private $params;
	/** @var bool */
	private $manual = true;
	/** @var bool */
	private $active = false;
	/** @var int|null */
	private $priority;

	/**
	 * @param string $className
	 * @param int $period
	 */
	public function __construct(
		string $className,
		int $period
	)
	{
		$this->className = $className;
		$this->period = $period;
	}

	/**
	 * @return string
	 */
	public function getClassName(): string
	{
		return $this->className;
	}

	/**
	 * @return int
	 */
	public function getPeriod(): int
	{
		return $this->period;
	}

	/**
	 * @return int|null
	 */
	public function getProjectId()
	{
		return $this->projectId;
	}

	/**
	 * @param int|null $projectId
	 * @return $this
	 */
	public function projectId(int $projectId = null)
	{
		$this->projectId = $projectId;
		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getLastRun()
	{
		return $this->lastRun;
	}

	/**
	 * @param \DateTime|null $lastRun
	 * @return $this
	 */
	public function lastRun(\DateTime $lastRun = null)
	{
		$this->lastRun = $lastRun;
		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getLastRunEnd()
	{
		return $this->lastRunEnd;
	}

	/**
	 * @param \DateTime|null $lastRunEnd
	 * @return $this
	 */
	public function lastRunEnd(\DateTime $lastRunEnd = null)
	{
		$this->lastRunEnd = $lastRunEnd;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getParams()
	{
		return $this->params;
	}

	/**
	 * @param string|null $params
	 * @return $this
	 */
	public function params(string $params = null)
	{
		$this->params = $params;
		return $this;
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
	 * @return $this
	 */
	public function manual(bool $manual = true)
	{
		$this->manual = $manual;
		return $this;
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
	 * @return $this
	 */
	public function active(bool $active)
	{
		$this->active = $active;
		return $this;
	}

	/**
	 * @return int|null
	 */
	public function getPriority()
	{
		return $this->priority;
	}

	/**
	 * @param int|null $priority
	 * @return $this
	 */
	public function priority(int $priority = null)
	{
		$this->priority = $priority;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function generateId(): bool
	{
		return !SchedulerJobSetting::isIdGeneratedByStorage();
	}

	/**
	 * @return SchedulerJobSetting
	 */
	public function build(): SchedulerJobSetting
	{
		return new SchedulerJobSetting($this);
	}

	/**
	 * @param string $className
	 * @param int $period
	 * @return self
	 */
	public static function create(
		string $className,
		int $period
	): self
	{
		return new self($className, $period);
	}
}