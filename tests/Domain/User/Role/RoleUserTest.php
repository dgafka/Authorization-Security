<?php

/**
 * Class RoleUserTest
 *
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class RoleUserTest extends PHPUnit_Framework_TestCase
{

	/** @var  \Dgafka\AnnotationSecurity\Domain\User\Role\RoleUser */
	private $roleUser;

	public function setUp()
	{
		$roles = new \Dgafka\AnnotationSecurity\Domain\User\Role\Roles([new \Dgafka\AnnotationSecurity\Domain\User\Role\Role('admin')]);

		$this->roleUser = new \Dgafka\AnnotationSecurity\Domain\User\Role\RoleUser('identity', $roles);
	}

	public function testHasRole()
	{
		$this->assertEquals(true, $this->roleUser->hasRole('admin'));
		$this->assertEquals(false, $this->roleUser->hasRole('moderator'));
	}

	public function testContainsRole()
	{
		$this->assertEquals(true, $this->roleUser->containsRole(['test', 'admin']));
		$this->assertEquals(false, $this->roleUser->containsRole(['test']));
	}

}