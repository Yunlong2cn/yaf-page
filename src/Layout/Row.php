<?php
namespace Leray\Yaf\Page\Layout;

use Yaf\View_Interface ;
use Yaf\View\Simple;

class Row
{
	private $view;
	private $content;

	private $columns;

	public function __construct($content = null, View_Interface $view = null)
	{
		$this->view = $view ?: new Simple(__DIR__ . '/../../views');

		$this->content = $content;
	}


	public function column($with, $content)
	{
		$column = new Column($content, $width);
		
		$this->addColumn($column);

		return $this;
	}

	public function addColumn(Column $column)
	{
		$this->columns[] = $column;

		return $this;
	}

	public function __toString()
	{
		$this->view->content = $this->content;

		return $this->view->render('row.phtml');
	}
}