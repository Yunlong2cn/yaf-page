<?php
namespace Leray\Yaf\Page\Component\Form;

use Closure;


class Group
{
	private $styles = [];
	private $content;

	public function __construct($content = null)
	{
		$this->style('form-group');// 增加默认样式

		if($content instanceof Closure) {
			call_user_func($content, $this);
		} else {
			$this->content = $content;
		}
	}

	public function push($data)
	{
		$this->content .= $data;

		return $this;
	}

	public function style($style = null)
	{
		$style && !in_array($style, $this->styles) && $this->styles[] = $style;

		return $this;
	}

	public function __toString()
	{
		$style = implode($this->styles, ' ');

		return sprintf('<div class="%s">%s</div>', $style, $this->content);
	}
}