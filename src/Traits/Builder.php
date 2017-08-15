<?php

namespace Leray\Yaf\Page\Traits;


use Closure;

use Leray\Yaf\Page\Component\Table;

trait Builder
{
	public static function grid(Closure $callback)
	{
		return new Table($callback, new static);
	}
}