<?php

namespace Dgafka\Security\Domain\User\Lattice;

/**
 * Class Permission - Permission level class
 *
 * @package Dgafka\Security\Domain\User
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
final class Permission
{

	/** @var int  */
	public $level;

	/**
	 * @param int $level
	 */
	public function __construct($level)
	{
		$this->setLevel($level);
	}

	/**
	 * @return int
	 */
	public function level()
	{
		return $this->level;
	}

	/**
	 * @param int $level
	 */
	private function setLevel($level)
	{

		if(!is_numeric($level)) {
			throw new \InvalidArgumentException;
		}

		$this->level = $level;
	}

}