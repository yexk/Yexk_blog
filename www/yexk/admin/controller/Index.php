<?php
namespace app\admin\controller;

use think\Session;

class Index extends Base
{
    public function index()
    {
    	return $this->fetch();
    }
    
    public function logout() 
    {
    	Session::clear();
    	$this->redirect('admin/Login/login');
    }
}
