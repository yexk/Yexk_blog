<?php
namespace app\admin\controller;
use think\Request;
use app\common\model\User;
use think\Controller;

class Login extends Controller
{
	public function _empty($name)
	{
		return __FUNCTION__ . $name;
	}
	public function _initialize()
	{
		$sess = session('admin_uid');
		if (!empty($sess))
		{
			$this->redirect('Index/index');
		}
	}
	public function login()
	{
		return $this->fetch('login');
	}
	
	/**
	 * 用户注册!
	 * @date 2016年9月8日
	 * @author Yexk
	 *
	 */
	public function register()
	{
		if (Request::instance()->isAjax())
		{
 			$post = Request::instance()->post();
			$User = new User();
			$res = $User->register($post);
			if ($res)
			{
				$this->success('注册成功！','Index/index');
			}
			else 
			{
				$this->error($User->getError());
			}
		} 
	}
	
	/**
	 * 登陆检测！
	 * @date 2016年9月8日
	 * @author Yexk
	 */
	public function checkLogin() {
		if (Request::instance()->isAjax())
			{
 			$post = Request::instance()->post();
			$User = new User();
			$res = $User->checkLogin($post);
			if ($res)
			{
				$this->success('登陆成功！','Index/index');
			}
			else 
			{
				$this->error($User->getError());
			}
		} 
	}
	
}