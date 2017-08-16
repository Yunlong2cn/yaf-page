<?php
namespace Leray\Yaf\Page;

use Closure;

use Leray\Yaf\Page\Layout\Content;

class Adminlte
{
	public function content(Closure $callback = null, $response = null)
	{
		$output = new Content($callback);

		if($response) {
			\Yaf\Dispatcher::getInstance()->disableView();
			return $response->setBody($output);
		}

		return $output;
	}
}