<?php
namespace Leray\Yaf\Page\Component;

use Closure;

use Yaf\View_Interface ;
use Yaf\View\Simple;


use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Collection;

class Table implements IComponent
{
	private $view;

	private $data = [];

	/**
	 * 表头
	 **/
	private $headers = [];


	// EloquentModel 数据模型
	private $model;
	

	/**
	 * 字段，用于展示数据
	 **/
	private $fields = [];

	public function __construct(Closure $callback = null, $model = null)
	{
		$this->view = new Simple(__DIR__ . '/../../views');

		$this->view->notfound = '暂无数据...';

		// $model && $this->data($model->data());

		$this->model = $model;

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

	public function model(Closure $callback = null)
	{
		$this->model = call_user_func($callback, $this->model);

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

		// 处理带模式时的数据
		if($this->model) {
			$this->data = $this->model instanceof Collection ?: $this->model->get();
		}


		$this->view->assign([
			'data' => $this->data,
			'headers' => $this->headers,
			'columnNumber' => count($this->headers)
		]);


		return $this->view->render('components/table.phtml');
	}
}