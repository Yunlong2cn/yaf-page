<?php
namespace Leray\Yaf\Page\Layout;

use Yaf\View_Interface ;
use Yaf\View\Simple;

class Column
{
	private $width;
	private $content;

	private $style;

	public function __construct($content = null, $width = 12, $styles = [])
	{
		$this->content = $content;

		array_unshift($styles, "col-xs-$width");

		$this->style = implode(' ', $styles);
	}

	public function __toString()
	{
		return "<div class='{$this->style}'>{$this->content}</div>";
	}
}