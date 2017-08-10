<?php
namespace Leray\Yaf\Page\Component;

use Closure;

use Yaf\View_Interface ;
use Yaf\View\Simple;

class Alert implements IComponent
{
	private $view;

	private $cards;

	private static $alert;

	public function __construct(Closure $callback = null, View_Interface $view = null)
	{
		$this->view = $view ?: new Simple(__DIR__ . '/../../views');
		
		$callback instanceof Closure && call_user_func($callback, $this);
	}

	public function push($data = null)
	{
		$this->view->content = $data;

		return $this;
	}

	public function body($data = null)
	{
		$this->view->content = $data;

		return $this;
	}

	public function title($title = null)
	{
		$this->view->title = $title;

		return $this;
	}

	public function __toString()
	{
		return $this->view->render('components/alert.phtml');
	}
}