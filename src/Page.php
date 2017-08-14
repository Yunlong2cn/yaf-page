<?php
namespace Leray\Yaf;

use Closure;
use Leray\Yaf\Layout;

use Yaf\View_Interface;
use Yaf\Response\Http as HttpReponse;
use Yaf\Dispatcher;

class Page
{
	public static function content(Closure $callable = null, &$response = null)
	{
		$out = new Page\Layout\Content($callable);

		if($response) {
			
			Dispatcher::getInstance()->disableView();

			return $response->setBody($out->__toString());
		} else {
			return $out;
		}
	}
}