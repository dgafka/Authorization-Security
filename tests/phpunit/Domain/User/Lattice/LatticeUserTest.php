<?php

/**
 * Class LatticeUserTest
 *
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class LatticeUserTest extends PHPUnit_Framework_TestCase
{

	/** @var  \Dgafka\Security\Domain\User\Lattice\LatticeUser */
	protected $latticeUser;

	/** @var  \Dgafka\Security\Domain\User\Lattice\Permission */
	protected $permission;

	public function setUp()
	{
		$this->permission = new \Dgafka\Security\Domain\User\Lattice\Permission(10);
		$this->latticeUser = new \Dgafka\Security\Domain\User\Lattice\LatticeUser('someID', $this->permission);
	}

	public function testInstanceOfUser()
	{
		$this->assertInstanceOf('\Dgafka\Security\Domain\User\User', $this->latticeUser);

	}

	public function testPermissionLevel()
	{
		$permission = $this->latticeUser->permission();
		$this->assertInstanceOf('\Dgafka\Security\Domain\User\Lattice\Permission', $permission);
		$this->assertEquals(10, $permission->level());
	}

}