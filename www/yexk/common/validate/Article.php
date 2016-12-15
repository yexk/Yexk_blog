<?php
/**
 * 文章验证器
 *
 * @author Yexk
 * @date 2016年12月15日
 */
namespace app\common\validate;

use think\Validate;

class Article extends Validate
{
	protected $rule = [
		'cid'     => 'require',
		'title'   => 'require',
		'content' => 'require',
	];
	
	protected $message = [
		'cid'     => '文章类型必须选择!',
		'title'   => '文章标题必须选择!',
		'content' => '文章内容不能为空!',				
	];
}
 