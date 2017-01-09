<?php
namespace app\admin\controller;

use app\common\controller\Yexk;
use think\Session;

class Base extends Yexk
{
	protected $ye_uid = NULL;
	
	protected function _initialize()
	{
		$this->assign('baseurl','/admin/');
		
		$this->ye_uid = Session::get('YE_UID');
		if (empty($this->ye_uid))
		{
			return $this->redirect('admin/Login/login');
			exit;
		}
		
	}
	
	
}
