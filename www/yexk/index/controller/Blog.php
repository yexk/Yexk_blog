<?php
namespace app\index\controller;

use app\common\model\Category;
use think\Request;
use app\common\model\Article;

class Blog extends Base
{
    public function index()
    {
        $this->redirect('index/Blog/blogList');
    }
    
    public function blogList()
    {
    	$Cate = new Category();
    	$this->assign('category',$Cate->readList());
    	
        return $this->fetch();
    }
    
    /**
     * 显示博客详情
     * @date 2017年2月5日
     * @author Yexk
     *
     * @param string $id
     * @return mixed|string
     */
    public function blog($id = '')
    {
		if ('' == $id && is_numeric($id)) {
			$this->redirect('/');
		}
		
		$Art = new Article();
		$this->assign('art',$Art->findOne($id));
		
		
        return $this->fetch();
    }
    
    /**
     * 获取当前分类下的文章。
     * @date 2017年2月5日
     * @author Yexk
     *
     * @return \app\common\model\number[]|\app\common\model\string[]|\app\common\model\unknown[]
     */
    public function getArticle() 
    {
    	$request = Request::instance();
    	if ($request->isAjax())
    	{
    	    $post = $request->post();
    	    $Article = new Article();
			
    	    return $Article->getCurrentCategoryArticle($post);
    		exit();
    		
    	}
    }
    
}
