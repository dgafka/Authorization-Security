<?php

/**
 * Class RoleTest
 *
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class RoleTest extends PHPUnit_Framework_TestCase
{

	/** @var  \Dgafka\AuthorizationSecurity\Domain\User\Role\Role */
	private $role;

	public function setUp()
	{
		$this->role = new \Dgafka\AuthorizationSecurity\Domain\User\Role\Role('admin');
	}

	public function testRoleName()
	{
		$this->assertEquals('admin', $this->role->name());
	}

}