<?php
namespace Leray\Yaf\Page\Layout;

use Yaf\View_Interface ;
use Yaf\View\Simple;

class Column
{
	private $view;
	private $content;

	public function __construct($content = null, View_Interface $view = null)
	{
		$this->view = $view ?: new Simple(__DIR__ . '/../../views');

		$this->view->content = $content;
	}

	public function __toString()
	{
		return $this->view->render('column.phtml');
	}
}