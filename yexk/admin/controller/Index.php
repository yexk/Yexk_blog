<?php
namespace app\admin\controller;

use app\common\model\User;

class Index extends Common
{
	public function index()
	{
		return $this->fetch('index');
	}

   	public function productList()
	{
		return $this->fetch('product_list');
	}

  	public function test()
	{
		phpinfo();
	}
	/**
	 * 退出登陆
	 * @date 2016年9月8日
	 * @author Yexk
	 */
	public function logout()
	{
		$User = new User();
		$User->logout();
		// 		return $this->fetch('login');
		$this->success('注销成功！',"Login/Login");
	}
}

