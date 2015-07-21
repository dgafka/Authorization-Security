<?php

namespace Dgafka\Security\Domain\User\Role;

/**
 * Class Role - describes user roles
 *
 * @package Dgafka\Security\Domain\User\Role
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
final class Role
{

	/** @var  string */
	private $name;

	/**
	 * @param string $name
	 */
	public function __construct($name)
	{
		$this->name = $name;
	}

	/**
	 * Returns role name
	 *
	 * @return string
	 */
	public function name()
	{
		return $this->name;
	}

}