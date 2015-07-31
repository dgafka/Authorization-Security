<?php

namespace Dgafka\AuthorizationSecurity\UI\Annotation;

use Doctrine\Common\Cache\FilesystemCache;
use Symfony\Component\ExpressionLanguage\ParsedExpression;
use Symfony\Component\ExpressionLanguage\ParserCache\ParserCacheInterface;

/**
 * Class ExpressionLanguageCache
 * @package Dgafka\AuthorizationSecurity\UI\Annotation
 */
class ExpressionLanguageCache implements ParserCacheInterface
{

    /** @var \Doctrine\Common\Cache\FilesystemCache  */
    private $fileSystemCache;

    /**
     * @param FilesystemCache $filesystemCache
     */
    public function __construct(FilesystemCache $filesystemCache)
    {
        $this->fileSystemCache = $filesystemCache;
    }

    /**
     * Saves an expression in the cache.
     *
     * @param string $key The cache key
     * @param ParsedExpression $expression A ParsedExpression instance to store in the cache
     */
    public function save($key, ParsedExpression $expression)
    {
        $this->fileSystemCache->save($key, $expression);
    }

    /**
     * Fetches an expression from the cache.
     *
     * @param string $key The cache key
     *
     * @return ParsedExpression|null
     */
    public function fetch($key)
    {
        $parsedExpression = $this->fileSystemCache->fetch($key);

        return $parsedExpression ? $parsedExpression : null;
    }

} 