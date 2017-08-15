# Table


-- Table 是基于 table 标签生成的表格组件，包含了 thead,tbody,tfoot 三部分，数据赋值目前包含两种方法。


```use Leray\Yaf\Page\Component\Table```


* 直接赋值

```
public function indexAction()
{
	$data = [
		[
			'id' => 1,
			'name' => '张三',
			'age' =>25
		], [
			'id' => 2,
			'name' => '李四',
			'age' =>23
		]
	];

	Adminlte::content(function($content) use ($data) {
		$content->header('用户')
				->description('列表')
				->body(new Table(function($grid) {
					$grid->title('全部用户')
						->id('编号')
						->name('姓名')
						->age('年龄');
				})->data($data));
	}, $this->getResponse());
}
```

* 结合 Eloquent ORM 赋值

-- 只需要更改 ->body(...) 中的内容即可，示例如下

```
UserModel::grid(function($grid) {
	$grid->title('全部用户')
		->id('编号')
		->name('姓名')
		->age('年龄');
});
```

-- 如果对数据需要进行条件筛选，则需要调用 model 方法，并设置回调函数即可

```
UserModel::grid(function($grid) {			
	$grid->title('....')
		->id('编号')
		->name('姓名')
		->age('年龄')
		->operation('操作')
		->model(function($model) {
			return $model->orderBy('id', 'desc');
		});

});
```