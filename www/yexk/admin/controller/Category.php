<?php
namespace app\admin\controller;

use think\Request;
use app\common\model\Category as CateModel;

class Category extends Base
{
	public function index() 
	{
		return $this->redirect('admin/Category/read');
	}

	/**
	 * 显示添加界面。ajax保存写入操作。
	 * @date 2016年12月5日
	 * @author Yexk
	 *
	 * @return void|mixed|string
	 */
    public function add()
    {
    	$request = Request::instance();
    	$CM      = new CateModel();
    	
    	if ($request->isAjax())
    	{
    	    $post = $request->post();
    	    $res  = $CM->write($post);
    	    if (1 === $res['code'])
    	    {
    	    	return $this->success($res['msg'],null,$res);
    	    }
    	    else 
    	    {    	    	
    	    	return $this->error($res['msg'],null,$res);
    	    }

    	    exit();
    	}
    	
    	$this->assign('cate_list',$CM->read());
    	return $this->fetch();
    }

    /**
     * 显示列表界面。ajax获取数据。
     * @date 2016年12月5日
     * @author Yexk
     *
     * @return mixed|string
     */
    public function read()
    {
    	$CM      = new CateModel();
    	$request = Request::instance();
    	if ($request->isAjax())
    	{
    	    $post = $request->post();
    	    $res = $CM->read($post);
			if (null !== $res)
			{
				$this->success('获取成功',null,$res);
			}
			else 
			{
				$this->success('未知错误！');
			}
    				
    		exit();
    	}
    	
    	$this->assign('cate_list',$CM->read());
    	return $this->fetch();
    }


}