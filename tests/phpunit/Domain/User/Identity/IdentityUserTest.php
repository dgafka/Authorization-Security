<?php

/**
 * Class IdentityUserTest
 *
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class IdentityUserTest extends PHPUnit_Framework_TestCase
{

	public function testConstruction()
	{
		$identityUser = new \Dgafka\Security\Domain\User\Identity\IdentityUser('identity');
		$this->assertEquals('identity', $identityUser->id());
	}

}