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
	/** @var int|null */
	private $priority;
	/** @var bool */
	private $manual = true;
	/** @var bool */
	private $active = false;

	/**
	 * @param string $className
	 */
	public function __construct(string $className)
	{
		$this->className = $className;
	}

	/**
	 * @return string
	 */
	public function getClassName(): string
	{
		return $this->className;
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
	 * @return self
	 */
	public static function create(string $className): self
	{
		return new self($className);
	}
}