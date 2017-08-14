<?php
namespace Leray\Yaf\Page\Component;

use Closure;



class Input
{
	private $attributes = [];

	public function __construct($type = 'text', $name = null, $value = null, Closure $callback = null)
	{
		$name && $this->attributes[] = sprintf('name="%s"', $name) && $this->attributes[] = sprintf('id="%s"', $name);

		$value && $this->attributes[] = sprintf('value="%s"', $value);

		$callback && call_user_func($callback, $this);
	}
	
	public function __call($method, $args)
	{
		$this->attributes[] = sprintf('%s="%s"', $method, $args[0]);

		return $this;
	}

	public function __toString()
	{
		$attributes = implode($this->attributes, ' ');

		return sprintf('<input type="text" class="form-control" %s/>', $attributes);
	}
}