<?php

/**
 * Class LatticeUserTest
 *
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class LatticeUserTest extends PHPUnit_Framework_TestCase
{

	/** @var  \Dgafka\AuthorizationSecurity\Domain\User\Lattice\LatticeUser */
	protected $latticeUser;

	/** @var  \Dgafka\AuthorizationSecurity\Domain\User\Lattice\Permission */
	protected $permission;

	public function setUp()
	{
		$this->permission = new \Dgafka\AuthorizationSecurity\Domain\User\Lattice\Permission(10);
		$this->latticeUser = new \Dgafka\AuthorizationSecurity\Domain\User\Lattice\LatticeUser('someID', $this->permission);
	}

	public function testInstanceOfUser()
	{
		$this->assertInstanceOf('\Dgafka\AuthorizationSecurity\Domain\User\User', $this->latticeUser);

	}

	public function testPermissionLevel()
	{
		$permission = $this->latticeUser->permission();
		$this->assertInstanceOf('\Dgafka\AuthorizationSecurity\Domain\User\Lattice\Permission', $permission);
		$this->assertEquals(10, $permission->level());
	}

}