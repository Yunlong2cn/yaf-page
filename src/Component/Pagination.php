<?php
namespace Leray\Yaf\Page\Component;

use Yaf\View\Simple;

use Illuminate\Pagination\AbstractPaginator;


class Pagination
{
	protected $paginator;

	public function __construct(AbstractPaginator $paginator)
	{
		$this->paginator = $paginator;
	}

	public function __toString()
	{
		$view = new Simple(__DIR__ . '/../../views');

		$view->paginator = $this->paginator;

		// var_dump($view->paginator);

		return $view->render('components/pagination/default.phtml');
	}
}