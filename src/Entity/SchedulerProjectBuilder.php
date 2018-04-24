<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\TBuilder;

/**
 * @see SchedulerProject
 */
class SchedulerProjectBuilder implements IBuilder
{
	use TBuilder;

	/** @var int */
	private $jobId;
	/** @var int */
	private $period;
	/** @var int|null */
	private $projectId;
	/** @var bool */
	private $active = false;

	/**
	 * @param int $jobId
	 * @param int $period
	 */
	public function __construct(
		int $jobId,
		int $period
	)
	{
		$this->jobId = $jobId;
		$this->period = $period;
	}

	/**
	 * @return int
	 */
	public function getJobId(): int
	{
		return $this->jobId;
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
		return !SchedulerProject::isIdGeneratedByStorage();
	}

	/**
	 * @return SchedulerProject
	 */
	public function build(): SchedulerProject
	{
		return new SchedulerProject($this);
	}

	/**
	 * @param int $jobId
	 * @param int $period
	 * @return self
	 */
	public static function create(
		int $jobId,
		int $period
	): self
	{
		return new self($jobId, $period);
	}
}