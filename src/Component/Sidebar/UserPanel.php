<?php

namespace Leray\Yaf\Page\Siderbar;

use Yaf\View\Simple;

class UserPanel
{
	public function __construct($name, $status = 'Offline', $avatar = '/dist/img/user2-160x160.jpg')
	{
		$this->name = $name;
		$this->status = $status;
		$this->avatar = $avatar;
	}

	public function __toString()
	{
		$view = new Simple(__DIR__ . '/../../../views');

		$view->assgin([
			'name' => $this->name,
			'avatar' => $this->avatar,
			'status' => $this->status,
		]);

		return $view->render('widgets/user-panel.phtml');
	}
}