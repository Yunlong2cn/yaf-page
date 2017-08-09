<?php
namespace Leray\Yaf;

use Closure;
use Leray\Yaf\Layout;

class Page
{
	public static function content(Closure $callable = null, Layout $layout = null)
	{
		return new Page\Layout\Content($callable, $layout);
	}
}