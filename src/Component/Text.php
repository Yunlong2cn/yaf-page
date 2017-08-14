<?php
namespace Leray\Yaf\Page\Component;

use Closure;

use Yaf\View_Interface ;
use Yaf\View\Simple;

class Text implements IComponent
{
	private $view;

	public function __construct($name, $label, Closure $callback = null)
	{
		$this->name = $name;
		$this->label = new Tag('label', $label);

		$callback instanceof Closure && call_user_func($callback, $this);
	}

	public function push($data = null)
	{
		$this->content = $data;

		return $this;
	}

	public function label(Closure $callback)
	{
		call_user_func($callback, $this->label);
		
		return $this;
	}

	public function placeholder($placeholder = null)
	{
		$this->placeholder = $placeholder;

		return $this;
	}

	public function __toString()
	{
		$input = sprintf('<input type="text" name="%s" class="form-control" placeholder="%s" value="%s">', $this->name, $this->placeholder, $this->content);
		$out = new Tag('div', $this->label . $input, 'form-group');
		return $out->__toString();
	}
}