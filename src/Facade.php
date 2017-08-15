<?php
namespace Leray\Yaf\Page;

use RuntimeException;


class Facade
{
	protected static $classes;

	protected static function getFacadeAccessor()
	{
		throw new Exception("Have no method named getFacadeAccessor");
	}

	public function getInstance($class)
	{
		if(!static::$classes[$class]) {
			static::$classes[$class] = new $class();
		}

		return static::$classes[$class];
	}

	public static function __callStatic($method, $args)
	{
		$instance = static::getInstance(static::getFacadeAccessor());

		return $instance->$method(...$args);
	}
}