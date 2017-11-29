<?php
namespace Sellastica\Scheduler\Entity;

use Sellastica\Entity\Entity\AbstractEntity;
use Sellastica\Entity\Entity\IEntity;
use Sellastica\Entity\Entity\TAbstractEntity;

/**
 * @generate-builder
 * @see SchedulerLogBuilder
 */
class SchedulerLog extends AbstractEntity implements IEntity
{
	use TAbstractEntity;

	/** @var int @required */
	private $jobId;
	/** @var int @required */
	private $projectId;
	/** @var \DateTime|null @optional */
	private $start;
	/** @var \DateTime|null @optional */
	private $end;
	/** @var bool|null @optional */
	private $success;
	/** @var bool @required */
	private $manual;
	/** @var string|null @optional */
	private $output;


	/**
	 * @param SchedulerLogBuilder $builder
	 */
	public function __construct(SchedulerLogBuilder $builder)
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
	 * @return \DateTime
	 */
	public function getStart(): \DateTime
	{
		return $this->start;
	}

	/**
	 * @param \DateTime|null $start
	 */
	public function setStart(\DateTime $start)
	{
		$this->start = $start;
	}

	/**
	 * @return \DateTime
	 */
	public function getEnd(): \DateTime
	{
		return $this->end;
	}

	/**
	 * @param \DateTime $end
	 */
	public function setEnd(\DateTime $end)
	{
		$this->end = $end;
	}

	/**
	 * @return bool|null
	 */
	public function getSuccess(): ?bool
	{
		return $this->success;
	}

	/**
	 * @param bool $success
	 */
	public function setSuccess(bool $success)
	{
		$this->success = $success;
	}

	/**
	 * @return boolean
	 */
	public function getManual(): bool
	{
		return $this->manual;
	}

	/**
	 * @return string|null
	 */
	public function getOutput(): ?string
	{
		return $this->output;
	}

	/**
	 * @param string $output
	 */
	public function setOutput(string $output)
	{
		$this->output = $output;
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
			'start' => $this->start,
			'end' => $this->end,
			'success' => $this->success,
			'manual' => $this->manual,
			'output' => $this->output,
		];
	}
}