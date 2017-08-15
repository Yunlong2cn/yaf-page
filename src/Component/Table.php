<?php
namespace Leray\Yaf\Page\Component;

use Closure;

use Yaf\View_Interface ;
use Yaf\View\Simple;

class Table implements IComponent
{
	private $view;

	private $data = [];

	/**
	 * 表头
	 **/
	private $headers = [];
	

	/**
	 * 字段，用于展示数据
	 **/
	private $fields = [];

	public function __construct(Closure $callback = null, $model = null)
	{
		$this->view = new Simple(__DIR__ . '/../../views');

		$this->view->notfound = '暂无数据...';

		$model && $this->data($model->data());

		$callback instanceof Closure && call_user_func($callback, $this);
	}

	public function push($data = [])
	{
		return $this;
	}

	public function title($title = null)
	{
		$this->view->title = $title;

		return $this;
	}

	public function header($header = [])
	{
		$this->headers = array_merge($this->headers, $header);

		return $this;
	}

	public function data($data = [])
	{
		$this->data = array_merge($this->data, $data);

		return $this;
	}

	public function notfound($notfound)
	{
		$this->view->notfound = $notfound;

		return $this;
	}

	public function __call($method, $arguments)
	{
		$this->headers[$method] = $arguments[0];

		return $this;
	}

	public function __toString()
	{
		$this->view->data = $this->data;
		$this->view->columnNumber = count($header);


		$this->view->assign([
			'data' => $this->data,
			'headers' => $this->headers,
			'columnNumber' => count($this->headers)
		]);


		return $this->view->render('components/table.phtml');
	}
}