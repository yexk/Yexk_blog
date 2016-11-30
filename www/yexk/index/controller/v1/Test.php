<?php
namespace app\index\controller\v1;
use app\index\controller\Base;

class Test extends Base
{
	public function index() 
	{
		return 1;
	}
	public function show()
	{
		return __FUNCTION__;
	}
}