<?php
namespace app\index\controller;

use app\common\controller\Yexk;
use think\Route;

class Base extends Yexk
{
    protected function _initialize()
    {
    	Route::rule('test/[:index]','index/v1.test/:index');
    	$this->assign('baseurl','/index/');
    }
}
