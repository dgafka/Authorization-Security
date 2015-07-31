<?php

namespace Dgafka\AuthorizationSecurity\UI\Annotation;
use Dgafka\AuthorizationSecurity\Application\Core;
use Dgafka\AuthorizationSecurity\Infrastructure\DIContainer;
use Dgafka\AuthorizationSecurity\Infrastructure\ExpressionReader;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\FilesystemCache;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

/**
 * Class AnnotationSecurity
 * @package Dgafka\AuthorizationSecurity\UI\Annotation
 */
class AnnotationSecurity
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
        AnnotationRegistry::registerAutoloadNamespace('\Dgafka\AuthorizationSecurity\UI\Annotation\Type', __DIR__ . '/Type');

        $expressionReader = new ExpressionReader(new ExpressionLanguage(
            $core->config()->debugMode() ? null : new ExpressionLanguageCache(new FilesystemCache($core->config()->cachePath() . '/expressions'))
        ));

        $aopKernel = Kernel::getInstance();
        $aopKernel->init(array(
            'debug'         => $core->config()->debugMode(),
            'cacheDir'      => $core->config()->cachePath() . '/aop',
            'includePaths'  => $core->config()->includePaths()
        ));

        $core->initialize(DIContainer::getInstance(), $expressionReader);
    }

} 