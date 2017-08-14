<?php
namespace Leray\Yaf\Page\Component;

use Closure;



class Form
{
	private $formId = 0;

	private $content;

	private $form;

	public static $data;

	public function __construct($id, Closure $callback = null)
	{
		$this->formId = $id;

		$callback && call_user_func($callback, $this);
	}

	public function push($data)
	{
		$this->form[] = $data;

		return $this;
	}

	public function data($data = null)
	{
		self::$data = $data;

		return $this;
	}
	
	public function __call($method, $args)
	{
		$this->attributes[] = sprintf('%s="%s"', $method, $args[0]);

		return $this;
	}

	public function __toString()
	{
		// $output

		// var_dump(self::$data);

		array_walk($this->form, function($form) {

			if(self::$data) {
				isset(self::$data[$form->field]) && $form->value(self::$data[$form->field]);
			}

			$this->content .= $form;

		});

		return sprintf('<form id="%s" onsubmit="return false;">%s</form>', $this->formId, $this->content);
	}
}