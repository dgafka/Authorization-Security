<?php

/**
 * Class PermissionTest
 *
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class PermissionTest extends PHPUnit_Framework_TestCase
{

	/** @var  \Dgafka\Security\Domain\User\Lattice\Permission */
	private $permission;

	public function setUp()
	{
		$this->permission = new \Dgafka\Security\Domain\User\Lattice\Permission(10);
	}

	public function testReturnPermissionLevel()
	{
		return $this->permission->level();
	}

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testExceptionWhenStringPassedAsLevel()
	{
		new \Dgafka\Security\Domain\User\Lattice\Permission('abc');
	}

}