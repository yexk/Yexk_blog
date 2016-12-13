<?php
namespace app\admin\controller;

use think\Request;
use app\common\model\Article as ArticleModel;
use app\common\model\Category;

/**
 * 文章管理
 *
 * @author Yexk
 * @date 2016年12月13日
 */
class Article extends Base
{
	public function index()
	{
		return $this->redirect('admin/Article/read');
	}
	
	public function add()
	{
		$CM = new Category();
		$this->assign('cate_list',$CM->read());
		return $this->fetch();
	}
	
	
	public function read()
	{
		$Ar = new ArticleModel();
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
		 
		$this->assign('article_list',$Ar->read());
		return $this->fetch();
	}
}