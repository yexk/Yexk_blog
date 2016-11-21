<?php
/**
 * 公有的控制器
 *
 * @author Yexk
 * @date 2016年8月31日
 */
 namespace app\admin\controller;
 
 use think\Controller;
    
class Common extends Controller 
{
	protected function _initialize()
	{
		$sess = session('admin_uid');
		if (!isset($sess))
		{
			$this->redirect('Login/login');
		}
	}
	
	public function _empty($name)
	{
		return __FUNCTION__;
	}
}