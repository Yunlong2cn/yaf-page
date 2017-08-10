<?php
namespace Leray\Yaf\Page\Component;

use Closure;

class Tag implements IComponent
{
	private $styles = [];

	private $tagName;

	private $content;


	public function __construct($tagName, $content = null, $style = 'default', $id = null, Closure $callback = null)
	{
		$this->tagName = $tagName;

		$content = $content instanceof Closure ? call_user_func($content) : $content;

		$content && $this->body($content);

		$style && $this->style($style);

		$callback instanceof Closure && call_user_func($callback, $this);
	}

	public function push($data)
	{
		return $this;
	}

	public function style($style)
	{
		$this->styles[] = $style;
	}

	public function body($body)
	{
		$this->content = $body;

		return $this;
	}

	public function __toString()
	{
		return '<'. $this->tagName .' class="'. implode(' ', $this->styles) .'">'. $this->content .'</'. $this->tagName .'>';
	}
}