<?php
namespace Leray\Yaf\Page\Component;

use Closure;

use Yaf\View_Interface ;
use Yaf\View\Simple;

class Button implements IComponent
{
	private $styles = ['btn'];


	public function __construct($body, $style = 'default', Closure $callback = null)
	{
		$body && $this->body($body);
		$style && $this->style($style);
		$block && $this->block();

		// $this->body = $body;

		$callback instanceof Closure && call_user_func($callback, $this);
	}

	public function push($data = null)
	{
		return $this;
	}

	public function body($body = null)
	{
		$this->body = $body;

		return $this;
	}

	public function style($style = 'default')
	{
		$this->styles[] = 'btn-' . $style;

		return $this;
	}

	public function block()
	{
		$this->styles[] = 'btn-block';

		return $this;
	}

	public function flat()
	{
		$this->styles[] = 'btn-flat';

		return $this;
	}

	public function link($link)
	{
		$this->link = $link;

		return $this;
	}

	public function __toString()
	{
		$class = implode(' ', $this->styles);

		if($this->link) {
			return '<a href="'. $this->link .'" class="'. $class .'">'. $this->body .'</a>';
		} else {
			return '<button type="button" class="'. $class .'">'. $this->body .'</button>';
		}
	}
}