<?php
namespace app\admin\controller;

use think\Request;

class Login extends Base
{
	public function index()
	{
		return $this->redirect('admin/Login/login');
	}
	
	public function login() 
	{
		$request = Request::instance();
		if ($request->isAjax())
		{
		    $post = $request->post();
			return $post;
					
			exit();
		}
		
		return $this->fetch();
	}
}