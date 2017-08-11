<?php
namespace Leray\Yaf\Page\Component\Timeline;

use Closure;

use Yaf\View\Simple;


class Item
{
	private $content;

	public function __construct($content, $time = null, $title = null, $subTitle = null, $footer = null)
	{
		$this->time = $time;
		$this->title = $title;
		$this->subTitle = $subTitle;
		$this->footer = $footer;

		if($content instanceof Closure) {
			call_user_func($content, $this);
		} else {
			$this->content = $content;
		}
	}

	public function __toString()
	{
		$view = new Simple(__DIR__ . '/../../../views');

		$view->assign([
			'title' => $this->title,
			'subTitle' => $this->subTitle,
			'time' => $this->time,
			'content' => $this->content,
			'footer' => $this->footer,
		]);

		return $view->render('components/timeline/item.phtml');
	}
}