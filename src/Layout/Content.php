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

		$content = $this->build();

		$this->view->assign([
			'header' => $this->header,
			'description' => $this->description,
			'content' => $content
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
	
	public function build()
	{
		ob_start();
        foreach ($this->rows as $row) {
            echo $row;
        }
        $content = ob_get_contents();
        ob_end_clean();

		return $content;
	}
}