<?php
namespace app\admin\controller;

class Category extends Base
{
	public function index() 
	{
		return $this->redirect('admin/Category/read');
	}

    public function add()
    {
    	return $this->fetch();
    }

    public function read()
    {
    	return $this->fetch();
    }

    public function myAdd() 
    {
    	dump('admin');
    	dump(md5('admin' . time()));
    	dump(md5('admin'));
    	return 1;
    }
}