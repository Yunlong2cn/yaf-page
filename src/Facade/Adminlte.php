<?php
namespace Leray\Yaf\Page\Facade;

use Leray\Yaf\Page\Facade;

class Adminlte extends Facade
{
	protected static function getFacadeAccessor()
	{
		return \Leray\Yaf\Page\Adminlte::class;
	}
}