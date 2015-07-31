<?php

namespace Dgafka\AuthorizationSecurity\UI\Basic;

use Dgafka\AuthorizationSecurity\Application\Api\Security;
use Dgafka\AuthorizationSecurity\Application\Api\SecurityCommand;
use Dgafka\AuthorizationSecurity\Application\Core;
use Dgafka\AuthorizationSecurity\Domain\Security\SecurityAccessDenied;
use Dgafka\AuthorizationSecurity\Infrastructure\DIContainer;
use Dgafka\AuthorizationSecurity\Infrastructure\ExpressionReader;
use Dgafka\AuthorizationSecurity\UI\Annotation\ExpressionLanguageCache;
use Doctrine\Common\Cache\FilesystemCache;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * Class BasicSecurity
 *
 * @package Dgafka\AuthorizationSecurity\UI\Basic
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class BasicSecurity
{

	/** @var  self */
	private static $instance;

	/**
	 * Returns instance of annotation security
	 *
	 * @return self
	 */
	public static function getInstance()
	{
		if(!isset($instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Initializes annotations in application.
	 *
	 * @param Core $core
	 */
	public function init(Core $core)
	{
		$expressionReader = new ExpressionReader(new ExpressionLanguage(
			$core->config()->debugMode() ? null : new ExpressionLanguageCache(new FilesystemCache($core->config()->cachePath() . '/expressions'))
		));

		$core->initialize(DIContainer::getInstance(), $expressionReader);
	}

	/**
	 * Check if user with given context is authorized to do some action
	 *
	 * @param SecurityCommand $securityCommand
	 *
	 * @return bool
	 */
	public function isAuthorized(SecurityCommand $securityCommand)
	{
		/** @var Security $security */
		$security     = DIContainer::getInstance()->get('security');

		$isAuthorized = true;
		try{
			$security->authorize($securityCommand);
		}catch (SecurityAccessDenied $e) {
			$isAuthorized = false;
		}

		return $isAuthorized;
	}

}