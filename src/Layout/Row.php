<?php
namespace Leray\Yaf\Page\Layout;

use Yaf\View_Interface ;
use Yaf\View\Simple;

use Closure;

class Row
{
	private $content;

	private $columns = [];

	public function __construct($content = null)
	{
		$content && $this->column(12, $content);
	}


	public function column($width, $content, $styles = [])
	{
		$column = new Column($content, $width, $styles);

		$callable instanceof Closure && call_user_func($callable, $column);
		
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
		array_walk($this->columns, function($column) {
			$this->content .= $column;
		});
		return '<div class="row">'. $this->content .'</div>';
	}
}