<?php
namespace Leray\Yaf\Page\Layout;

use Closure;

use Yaf\View_Interface;
use Yaf\View\Simple;

use Leray\Yaf\Page\Component\IComponent;

class Content
{
	private $view;
	private $rows = [];

	private $vars = [];

	private $content;// 内容

	private $response;

	public function __construct(Closure $callback = null)
	{
		if ($callback instanceof Closure) {
            $callback($this);
        }
	}

	public function __set($key, $value)
	{
		$this->$key = $value;
	}

	public function row($content)
	{

		if($content instanceof Closure) {
			$row = call_user_func($content, new Row);
		} else {
			$row = new Row($content);
		}

		$this->rows[] = $row;

		return $this;
	}

	public function setResponse($response)
	{
		$this->response = $response;

		return $this;
	}

	public function __call($method, $args)
	{
		$this->vars[$method] = $args[0];

		return $this;
	}

	public function __toString()
	{
		$view = new Simple(__DIR__ . '/../../views');

		$view->assign($this->vars);

		array_walk_recursive($this->rows, function($row) {
			$this->content .= $row;
		});

		$view->content = $this->content;

		$out = $view->render('content.phtml');

		if($this->response) {
			return $this->response->setBody($out);
		}

		return $out;
	}
}