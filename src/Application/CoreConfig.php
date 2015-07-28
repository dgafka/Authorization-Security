<?php

namespace Dgafka\AuthorizationSecurity\Application;

/**
 * Class CoreConfig
 *
 * @package Dgafka\AuthorizationSecurity\Application
 * @author Dariusz Gafka <dgafka.mail@gmail.com>
 */
class CoreConfig
{

	/** @var array  Array of paths, where Security will be applied. Example: array(__DIR__ . '/src/') */
	private $includePaths;

	/** @var string  Path to folder where all cached files will be stored. */
	private $cachePath;

	/** @var bool True - on development, False - on production */
	private $debugMode;

	/**
	 * @param array  $includePaths Array of paths, where Security will be applied. Example: array(__DIR__ . '/src/')
	 * @param string $cachePath Path to folder where all cached files will be stored.
	 * @param bool   $debugMode True - on development, False - on production
	 */
	public function __construct(array $includePaths, $cachePath, $debugMode = true)
	{
		$this->setIncludePaths($includePaths);
		$this->setCachePath($cachePath);
		$this->setDebugMode($debugMode);
	}

	/**
	 * @return array
	 */
	public function includePaths()
	{
		return $this->includePaths;
	}

	/**
	 * @return string
	 */
	public function cachePath()
	{
		return $this->cachePath;
	}

	/**
	 * @return bool
	 */
	public function debugMode()
	{
		return $this->debugMode;
	}

	/**
	 * @param array $includePaths
	 */
	private function setIncludePaths(array $includePaths)
	{

		foreach($includePaths as $path) {
			if(!is_readable($path)) {
				throw new \InvalidArgumentException("Have no read access to {$path}");
			}
		}

		$this->includePaths = $includePaths;
	}

	/**
	 * @param string $cachePath
	 */
	private function setCachePath($cachePath)
	{

		if(!file_exists($cachePath)) {
			mkdir($cachePath, 0775, true);
		}

		if(!is_readable($cachePath) || !is_writable($cachePath)) {
			throw new \InvalidArgumentException("Have no access to cache folder {$cachePath}");
		}

		$this->cachePath = $cachePath;
	}

	/**
	 * @param bool $debugMode
	 */
	private function setDebugMode($debugMode)
	{
		if(!is_bool($debugMode)) {
			$debugType = gettype($debugMode);
			throw new \InvalidArgumentException("DebugMode must be bool. Passed {$debugType}");
		}

		$this->debugMode = $debugMode;
	}

}