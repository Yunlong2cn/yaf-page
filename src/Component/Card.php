<?php
namespace Leray\Yaf\Page\Component;

use Closure;

use Yaf\View_Interface ;
use Yaf\View\Simple;

class Card implements IComponent
{
	private $view;

	private $cards;

	public function __construct(Closure $callback = null, View_Interface $view = null)
	{
		$this->view = $view ?: new Simple(__DIR__ . '/../../views');
	}

	public function push($data = [])
	{
		$this->cards[] = $data;

		return $this;
	}

	public function __toString()
	{
		$this->view->assign('cards', $this->cards);

		return $this->view->render('components/card.phtml');
	}
}