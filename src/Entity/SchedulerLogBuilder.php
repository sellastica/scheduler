<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\IBuilder;
use Sellastica\Entity\TBuilder;

/**
 * @see SchedulerLog
 */
class SchedulerLogBuilder implements IBuilder
{
	use TBuilder;

	/** @var int */
	private $jobId;
	/** @var int */
	private $projectId;
	/** @var bool */
	private $manual;
	/** @var \DateTime|null */
	private $start;
	/** @var \DateTime|null */
	private $end;
	/** @var bool|null */
	private $success;
	/** @var string|null */
	private $output;

	/**
	 * @param int $jobId
	 * @param int $projectId
	 * @param bool $manual
	 */
	public function __construct(
		int $jobId,
		int $projectId,
		bool $manual
	)
	{
		$this->jobId = $jobId;
		$this->projectId = $projectId;
		$this->manual = $manual;
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
	public function getProjectId(): int
	{
		return $this->projectId;
	}

	/**
	 * @return bool
	 */
	public function getManual(): bool
	{
		return $this->manual;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getStart()
	{
		return $this->start;
	}

	/**
	 * @param \DateTime|null $start
	 * @return $this
	 */
	public function start(\DateTime $start = null)
	{
		$this->start = $start;
		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getEnd()
	{
		return $this->end;
	}

	/**
	 * @param \DateTime|null $end
	 * @return $this
	 */
	public function end(\DateTime $end = null)
	{
		$this->end = $end;
		return $this;
	}

	/**
	 * @return bool|null
	 */
	public function getSuccess()
	{
		return $this->success;
	}

	/**
	 * @param bool|null $success
	 * @return $this
	 */
	public function success(bool $success = null)
	{
		$this->success = $success;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getOutput()
	{
		return $this->output;
	}

	/**
	 * @param string|null $output
	 * @return $this
	 */
	public function output(string $output = null)
	{
		$this->output = $output;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function generateId(): bool
	{
		return !SchedulerLog::isIdGeneratedByStorage();
	}

	/**
	 * @return SchedulerLog
	 */
	public function build(): SchedulerLog
	{
		return new SchedulerLog($this);
	}

	/**
	 * @param int $jobId
	 * @param int $projectId
	 * @param bool $manual
	 * @return self
	 */
	public static function create(
		int $jobId,
		int $projectId,
		bool $manual
	): self
	{
		return new self($jobId, $projectId, $manual);
	}
}