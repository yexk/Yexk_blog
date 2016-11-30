<?php
namespace app\index\controller;

use app\common\controller\Yexk;

class Base extends Yexk
{
    protected function _initialize()
    {
    	$this->assign('baseurl','/index/');
    }
}
