<?php
namespace app\admin\controller;

use think\Request;
use app\common\model\User;
use think\Controller;
use think\Session;

class Login extends Controller
{
	protected function _initialize()
	{
		$this->assign('baseurl','/admin/');
		$ye_uid = Session::get('YE_UID');
		if (!empty($ye_uid))
		{
			return $this->redirect('admin/Index/index');
			exit;
		}
	}
	
	public function index()
	{
		return $this->redirect('admin/Login/login');
	}
	
	/**
	 * 默认登陆检查
	 * @date 2017年1月9日
	 * @author Yexk
	 *
	 * @return number[]|string[]|mixed|string
	 */
	public function login() 
	{
		$request = Request::instance();
		if ($request->isAjax())
		{
		    $post = $request->post();
		    $User = new User();
		    $res = $User->checkLogin($post);
			return $res;
			exit();
		}
		
		return $this->fetch();
	}
}