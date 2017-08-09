<?php
namespace Leray\Yaf\Page\Layout;

use Yaf\View_Interface ;
use Yaf\View\Simple;

class Row
{
	private $view;

	public function __construct(Closure $callback, View_Interface $view = null)
	{
		$this->view = $view ?: new Simple(__DIR__ . '/../../views');
	}

	public function __destruct()
	{
		$this->view->content = 'sdfa';
		$this->view->render('row.phtml');
	}
}