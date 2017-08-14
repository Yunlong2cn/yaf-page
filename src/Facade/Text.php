<?php
namespace Leray\Yaf\Page\Facade;

use Closure;


use Leray\Yaf\Page\Component\Form;
use Leray\Yaf\Page\Component\Label;
use Leray\Yaf\Page\Component\Input;

class Text
{
	public $field;

	public function __construct($field, $label, $placeholder = null, $value = null, $style = null)
	{
		$this->field = $field;
		$this->label = $label;
		$this->placeholder = $placeholder;
		$this->style = $style;
		$this->value = $value;
	}

	public function value($value = null)
	{
		$this->value = $value;

		return $this;
	}

	public function __toString()
	{
		$out = new Form\Group(function($group) {
			$group->style($style)
				->push(new Label($this->label, $this->field, $this->style))
				->push(new Input('text', $this->field, $this->value, function($input) {
					$input->placeholder($this->placeholder);
				}));
		});


		return $out->__toString();
	}
}