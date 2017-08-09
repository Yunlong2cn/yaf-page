<?php
namespace Leray\Yaf\Page\Layout;

use Closure;

use Yaf\View_Interface ;
use Yaf\View\Simple;

class Content
{
	private $view;

	public function __construct(Closure $callback = null, View_Interface $view = null)
	{
		if ($callback instanceof Closure) {
            $callback($this);
        }

        $this->view = $view ?: new Simple(__DIR__ . '/../../views');

	}

	public function __set($key, $value)
	{
		$this->$key = $value;
	}

	public function __destruct()
	{

		$this->view->assign([
			'header' => $this->header,
			'description' => $this->description
		]);

		$content = $this->view->render('content.phtml');
		$this->view->content = $content;
		$this->view->assign([
			'title' => $this->title
		]);

		return $this->view->display('index.phtml');
	}

	public function header($header = '')
	{
		$this->header = $header;

		return $this;
	}

	public function description($description = '')
	{
		$this->description = $description;

		return $this;
	}

	public function title($title = '')
	{
		$this->title = $title;

		return $this;
	}

	public function row(Closure $callback)
	{
		return $this;
	}
}