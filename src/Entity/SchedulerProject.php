<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\Entity\AbstractEntity;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\Entity\TAbstractEntity;

/**
 * @generate-builder
 * @see SchedulerProjectBuilder
 */
class SchedulerProject extends AbstractEntity implements IEntity
{
	use TAbstractEntity;

	/** @var int @required */
	private $jobId;
	/** @var int @required */
	private $period;
	/** @var int|null @optional Null = all projects */
	private $projectId;
	/** @var bool @optional */
	private $active = false;


	/**
	 * @param SchedulerProjectBuilder $builder
	 */
	public function __construct(SchedulerProjectBuilder $builder)
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
	 * @return int
	 */
	public function getJobId(): int
	{
		return $this->jobId;
	}

	/**
	 * @param int $jobId
	 */
	public function setJobId(int $jobId): void
	{
		$this->jobId = $jobId;
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
	 * @return bool
	 */
	public function isActive(): bool
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
	 * @return array
	 */
	public function toArray(): array
	{
		return [
			'id' => $this->id,
			'jobId' => $this->jobId,
			'projectId' => $this->projectId,
			'period' => $this->period,
			'active' => $this->active,
		];
	}
}