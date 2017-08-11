<?php
namespace Leray\Yaf\Page\Component;

use Closure;

class Timeline
{
	private $timelines = [];

	private $body;

	public function __construct($content)
	{
		if($content instanceof Closure) {
			call_user_func($content, $this);
		}
	}

	public function label($content, $style = 'bg-red')
	{
		$label = new Timeline\Label($content, $style);
		
		$this->addLabel($label);

		return $this;
	}

	public function addLabel(Timeline\Label $label)
	{
		$this->timelines[] = $label;

		return $this;
	}

	public function item($content, Closure $callback = null)
	{
		$item = new Timeline\Item($content);

		call_user_func($callback, $item);
		
		$this->addItem($item);

		return $this;
	}

	public function addItem(Timeline\Item $item)
	{

		$this->timelines[] = $item;
		
		return $this;
	}

	public function __toString()
	{
		array_walk($this->timelines, function($item) {
			$this->body .= $item;
		});

		return sprintf('<ul class="timeline">%s<li><i class="fa fa-clock-o bg-gray"></i></li></ul>', $this->body);
	}
}