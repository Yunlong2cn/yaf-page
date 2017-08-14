<?php
namespace Leray\Yaf\Page\Component;

use Closure;



class Label
{
	private $formId = 0;

	private $content;

	private $style = [];

	public function __construct($content, $for = null, $style = null)
	{
		$this->content = $content;
		$this->for = $for;
		$this->style = is_array($style) ? $style : [$style];
	}

	public function push($data)
	{
		return $this;
	}

	public function __toString()
	{
		return sprintf('<label class="%s" for="%s">%s</label>', implode($this->style, ' '), $this->for, $this->content);
	}
}