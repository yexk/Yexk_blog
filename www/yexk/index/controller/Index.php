<?php
namespace app\index\controller;

use app\common\model\Article;

class Index extends Base
{
    /**
     * 展示首页
     * 获取热门文章
     * @Author Yexk
     * @Date   2017-02-05
     * @return [null]
     */
    public function index()
    {
    	// 热门文章 （3条）
    	$Art = new Article();
    	$this->assign('article',$Art->getHot());
    	
    	// 最新文章 （4条）
    	$this->assign('article_new',$Art->getNew());
    	
    	return $this->fetch();
    }
    
}
