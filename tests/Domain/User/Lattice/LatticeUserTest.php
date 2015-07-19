<?php

/**
 * Class LatticeUserTest
 *
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class LatticeUserTest extends PHPUnit_Framework_TestCase
{

	/** @var  \Dgafka\AnnotationSecurity\Domain\User\Lattice\LatticeUser */
	protected $latticeUser;

	/** @var  \Dgafka\AnnotationSecurity\Domain\User\Lattice\Permission */
	protected $permission;

	public function setUp()
	{
		$this->permission = new \Dgafka\AnnotationSecurity\Domain\User\Lattice\Permission(10);
		$this->latticeUser = new \Dgafka\AnnotationSecurity\Domain\User\Lattice\LatticeUser('someID', $this->permission);
	}

	public function testInstanceOfUser()
	{
		$this->assertInstanceOf('\Dgafka\AnnotationSecurity\Domain\User\User', $this->latticeUser);

	}

	public function testPermissionLevel()
	{
		$permission = $this->latticeUser->permission();
		$this->assertInstanceOf('\Dgafka\AnnotationSecurity\Domain\User\Lattice\Permission', $permission);
		$this->assertEquals(10, $permission->level());
	}

}