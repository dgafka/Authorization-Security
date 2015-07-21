<?php

namespace Dgafka\Security\Domain\User;

/**
 * Class User - Currently logged user in the system
 * All properties, that need to be used in access control need to be public
 *
 * @package Dgafka\Security\User
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
abstract class User
{

	/**
	 * @var string
	 */
	public $id;

	/**
	 * @param string $id
	 */
	public function __construct($id)
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function id()
	{
		return $this->id;
	}

}
