<?php

namespace Dgafka\AuthorizationSecurity\UI\Annotation;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\Around;

/**
 * Class AuthorizationSecurity - Main authorization security. Marks method for authorization checking.
 *
 * @package Dgafka\AuthorizationSecurity\UI\Annotation
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class AuthorizationSecurity implements Aspect
{

	/** @Pointcut("@annotation()") */
	private $authorizePointcut;

	/**
	 * This method will be called before execution
	 *
	 * @param MethodInvocation $invocation
	 * @Around("")
	 */
	public function authorize(MethodInvocation $invocation)
	{

	}

}