<?php
namespace Leray\Yaf\Page\Component;

use Closure;

use Yaf\View_Interface ;
use Yaf\View\Simple;


use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

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


	private $options = [
		'useExporter'       => true,
        'allowCreate'       => true,
        'allowBatchDelete'  => true,
	];

	public function __construct(Closure $callback = null, $model = null)
	{
		$this->view = new Simple(__DIR__ . '/../../views');

		$this->view->notfound = '暂无数据...';

		$this->model = $model;

		$callback instanceof Closure && call_user_func($callback, $this);
	}

	public function option($key, $value = null)
	{
		if(is_null($value)) return $this->options[$key];

		$this->options[$key] = $value;

		return $this;
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

	/**
	 * 关于此 table 列表的相关操作
	 * 增、删
	 * 
	 **/
	public function actions()
	{
		return $this;
	}

	// 禁用导出数据，默认允许
	public function disableExport()
	{
		return $this->option('useExporter', false);
	}

	public function handleTitle()
	{
		$title = null;

		array_walk($this->options, function($value, $key) use (&$title) {
			$value && $title .= (function($option) {
				switch ($option) {
					case 'allowCreate':
						$button = new Button('新增', 'success', function($button) {
							$button->link('create');
						});
						break;
					case 'useExporter':
						$button = new Button('导出', 'success', function($button) {
							$button->link('export');
						});
						break;
					case 'allowBatchDelete':
						$button = new Button('批量删除', 'success', function($button) {
							$button->link('batch-delete');
						});
						break;
					default:
						$button = new Button($option);
						break;
				}

				return new Tag('div', $button, 'btn-group');
			})($key);
		});

		$title && $this->view->title = $title;// new Tag('div', $title, 'btn-group');
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
			$this->data = $this->model instanceof Collection ?: $this->model->orderBy('id', 'desc')->paginate(3);
		}

		// 处理标题
		$this->handleTitle();

		// echo new Pagination($this->data);


		$this->view->assign([
			'data' => $this->data,
			'headers' => $this->headers,
			'columnNumber' => count($this->headers)
		]);


		return $this->view->render('components/table.phtml');
	}
}