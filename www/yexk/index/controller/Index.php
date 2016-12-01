<?php
namespace app\index\controller;

class Index extends Base
{
    public function index()
    {
		return $this->fetch();
    }
    
    public function blog()
    {
    	return $this->fetch();
    }
    
    public function blogList()
    {    	
    	return $this->fetch();
    }
}
