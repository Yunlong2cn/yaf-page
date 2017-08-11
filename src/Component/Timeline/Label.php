<?php
namespace Leray\Yaf\Page\Component\Timeline;

use Closure;


$template = <<<TEMPLATE
<li class="time-label">
	<span class="%s">%s</span>
</li>
TEMPLATE;

class Label
{
	private $content;
	private $style;

	private $template;

	public function __construct($content, $style)
	{
		$this->content = $content;
		$this->style = $style;
	}


	public function __toString()
	{
		return sprintf('<li class="time-label"><span class="%s">%s</span></li>', $this->style, $this->content);
	}
}