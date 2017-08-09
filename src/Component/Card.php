<?php
namespace Leray\Yaf\Page\Component;

use Closure;

use Yaf\View_Interface ;
use Yaf\View\Simple;

class Card
{
	private $view;

	private $cards;

	public function __construct(Closure $callback, View_Interface $view = null)
	{
		$this->view = $view ?: new Simple(__DIR__ . '/../../views');
	}

	public function __destruct()
	{
		$this->view->assign('cards', $this->cards);
		$this->view->render('components/card.phtml');
	}

	public function add($data = [])
	{
		$this->cards[] = $data;

		return $this;
	}
}