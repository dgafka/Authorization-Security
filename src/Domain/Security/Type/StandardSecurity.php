<?php

namespace Dgafka\AnnotationSecurity\Domain\Security\Type;

use Dgafka\AnnotationSecurity\Domain\Expression\Expression;
use Dgafka\AnnotationSecurity\Domain\Expression\ExpressionReader;
use Dgafka\AnnotationSecurity\Domain\Resource\BaseResource;
use Dgafka\AnnotationSecurity\Domain\Security\Security;
use Dgafka\AnnotationSecurity\Domain\Security\SecurityAccessDenied;
use Dgafka\AnnotationSecurity\Domain\Security\SecurityPolicy;
use Dgafka\AnnotationSecurity\Domain\User\User;

/**
 * Class RoleBasedSecurity - Role Based Security control - Check, if user contains given role
 *
 * @package Dgafka\AnnotationSecurity\Domain\Security\Type
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class StandardSecurity implements Security
{

	/** @var  ExpressionReader */
	private $expressionReader;

	/**
	 * @param ExpressionReader $expressionReader
	 */
	public function __construct(ExpressionReader $expressionReader)
	{
		$this->expressionReader = $expressionReader;
	}

	/**
	 * @inheritdoc
	 */
	public function execute(Expression $expression, User $user, BaseResource $resource = null, array $policies = array())
	{
		if(!$this->expressionReader->evaluate($expression, ['user' => $user, 'resource' => $resource])) {
			throw new SecurityAccessDenied("User: {$user->id()} have no access to this resource.");
		};

		/** @var SecurityPolicy $securityPolicy */
		foreach($policies as $securityPolicy) {
			if(!$securityPolicy->execute($user, $resource)) {
				throw new SecurityAccessDenied("User: {$user->id()} have no access to this resource.");
			};
		}
	}

}