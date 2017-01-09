<?php
/**
 * 用户登陆验证器
 *
 * @author Yexk
 * @date 2017年1月9日
 */
namespace app\common\validate;

use think\Validate;

class User extends Validate
{
	protected $rule = [
		'username' => 'require|token',
		'password' => 'require'
	];
	
	protected $message = [
		'username:require' => '请填写用户名',
		'password' => '请填写密码'		
	];
}
 