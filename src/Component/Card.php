<?php
namespace Leray\Yaf\Page\Component;

use Closure;

use Yaf\View_Interface ;
use Yaf\View\Simple;

class Card implements IComponent
{
	private $view;

	private $vars;

	public function __construct(Closure $callback = null, View_Interface $view = null)
	{
		$this->view = $view ?: new Simple(__DIR__ . '/../../views');

		$callback instanceof Closure && call_user_func($callback, $this);
	}

	public function push($data = [])
	{
		return $this;
	}

	public function __call($method, $args)
	{
		$this->vars[$method] = $args[0];

		return $this;
	}

	public function __toString()
	{
		$this->view->assign($this->vars);

		return $this->view->render('components/card.phtml');
	}
}