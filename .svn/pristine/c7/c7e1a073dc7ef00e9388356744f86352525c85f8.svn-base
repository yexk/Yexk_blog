<?php
namespace app\index\controller;

use think\View;
use think\Config;
use app\index\model\User;
use think\Db;
use think\Controller;
use think\Request;
use think\Model;
use think\Loader;

class Index extends Controller
{
	public function index()
	{
		$view = new View([],Config::get('view_replace_str'));
		return $view->fetch('index');
//      return view();
	}
    
	public function testAdd() 
	{
	    if (Request::instance()->isPost()) 
	    {
	        $arr = Request::instance()->post();
	        $data = [
	                'name'=>$arr['username'],
	                'email'=>$arr['email'],
	                'password'=>md5($arr['password']),
	        ];
	        
	        $validate = Loader::validate('User');
	        
	        if(!$validate->check($data)){
	            return $this->error($validate->getError(),'index/testAdd');
	        }
	        $arr['password'] = md5($arr['password']);
	        $arr['reg_time'] = time();
	        if (Db::name('user')->insert($arr))
	        {
    	        return $this->success('恭喜你,登录成功!','index/index');
	        }
	        else 
	        {	            
    	        return $this->error('对不起!登录失败','index/testAdd');	            
	        }
	    }
	    return $this->fetch('showform');
	    
	}
	
	public function test() 
	{
        return $this->success('恭喜你,登录成功!','index/index');
	    $request = Request::instance();
        echo '请求方法：' . $request->method() . '<br/>';
        echo '资源类型：' . $request->type() . '<br/>';
        echo '访问地址：' . $request->ip() . '<br/>';
        echo '是否AJax请求：' . var_export($request->isAjax(), true) . '<br/>';
        echo '请求参数：';
        dump($request->param());
        echo '请求参数：仅包含name';
        dump($request->only(['name']));
        echo '请求参数：排除name';
        dump($request->except(['name']));;
	}

	public function test1()
	{
	    $user = new \app\common\model\User();
		return $user->test();
	}
}

