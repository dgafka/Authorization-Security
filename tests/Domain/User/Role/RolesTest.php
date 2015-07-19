<?php

/**
 * Class RolesTest
 *
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class RolesTest extends PHPUnit_Framework_TestCase
{

	/** @var  \Dgafka\AnnotationSecurity\Domain\User\Role\Roles */
	private $roles;

	public function setUp()
	{
		$this->roles      = new \Dgafka\AnnotationSecurity\Domain\User\Role\Roles([new \Dgafka\AnnotationSecurity\Domain\User\Role\Role('admin'), new \Dgafka\AnnotationSecurity\Domain\User\Role\Role('moderator')]);
	}


	public function testContainsRole()
	{
		$this->assertEquals(true, $this->roles->containsRole(['admin']));
		$this->assertEquals(false, $this->roles->containsRole(['test']));
		$this->assertEquals(true, $this->roles->containsRole(['test', 'moderator']));
	}

	public function testHasRole()
	{
		$this->assertEquals(true, $this->roles->hasRole('admin'));
		$this->assertEquals(false, $this->roles->hasRole('test'));
	}

}