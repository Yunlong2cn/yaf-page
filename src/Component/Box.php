<?php
namespace Leray\Yaf\Page\Component;

use Closure;

class Box
{
	private $styles = [];
	private $headerStyles = [];

	private $content;

	public function __construct($title, $content = null)
	{
		$this->style('box');

		$this->title = $title;

		if($content instanceof Closure) {
			call_user_func($content, $this);
		} else {
			$this->content = $content;
		}
	}

	public function push($data = null)
	{
		$data && $this->content .= $data;

		return $this;
	}

	public function style($style = null)
	{
		$style && !in_array($style, $this->styles) && array_push($this->styles, $style);

		return $this;
	}



	public function __toString()
	{

$template = <<<TEMPLATE
<div class="%s">
	<div class="box-header with-border">
		<h3 class="box-title">%s</h3>
	</div>
	<div class="box-body">%s</div>
</div>
TEMPLATE;


		return sprintf($template, implode($this->styles, ' '), $this->title, $this->content);
	}
}