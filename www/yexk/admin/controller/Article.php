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
	
	/**
	 * 显示添加页面和保存添加数据
	 * @date 2017年1月9日
	 * @author Yexk
	 *
	 * @return view | Object
	 */
	public function add()
	{
		$CM = new Category();
		$Ar = new ArticleModel();
		$request = Request::instance();
		if ($request->isAjax())
		{
		    $post = $request->post();
		    return $Ar->write($post);
					
			exit();
		}
		
		$this->assign('cate_list',$CM->read());
		return $this->fetch();
	}
	
	/**
	 * 文章列表读取和展示列表
	 * @date 2017年1月9日
	 * @author Yexk
	 *
	 * @return mixed|string 
	 */	
	public function read()
	{
		$Ar = new ArticleModel();
		$request = Request::instance();
		if ($request->isAjax())
		{
			$post = $request->post();
			echo $Ar->read($post);
			
			exit();
		}
		 
		$this->assign('article_list',$Ar->read());
		return $this->fetch();
	}
	
	/**
	 * 修改显示修改文章内容和保存修改后的文章数据
	 * @date 2017年1月9日
	 * @author Yexk
	 *
	 * @param string $id 文章ID
	 * @return void|number[]|string[]|mixed|string 然后显示编辑的内容
	 */
	public function modify($id = '')
	{
		if (!$id)
		{
			$this->redirect('admin/Article/read');
			exit;
		}
		
		$CM = new Category();
		$Ar = new ArticleModel();
		$request = Request::instance();
		if ($request->isAjax())
		{
			$post = $request->post();
			return $Ar->write($post);
				
			exit();
		}
		$this->assign('cur_art',$Ar->findOne($id));
		$this->assign('cate_list',$CM->read());
		return $this->fetch();
	}
	
	public function del()
	{
		$Ar = new ArticleModel();
		$request = Request::instance();
		if ($request->isAjax())
		{
			$post = $request->post();
			if (!isset($post['id']))
			{
				$this->redirect('admin/Article/read');
				exit;
			}
			
			return $Ar->del($post['id']);
		
			exit();
		}
		
	}
	
}