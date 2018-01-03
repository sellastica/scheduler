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
	/** @var string|null @optional */
	private $params;
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
			'className' => $this->className,
			'params' => $this->params,
			'priority' => $this->priority,
			'manual' => $this->manual,
			'active' => $this->active,
		];
	}
}