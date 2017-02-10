<?php
/**
 * 文章模型
 * 处理数据的增删改查
 * 
 * @author Yexk
 * @date 2016年12月1日
 */
namespace app\common\model;

use think\Model;
use think\Session;
use think\Cookie;

class Article extends Model
{
	// 自动写入时间戳
	protected $autoWriteTimestamp = TRUE;
	// 最懂数据类型转换
	protected $type = [
		'create_time'  =>  'timestamp:Y-m-d H:i:s',
	];
	
	/**
	 * 文章列表的读取
	 * @date 2017年1月9日
	 * @author Yexk
	 *
	 * @param array $post 表格的搜索条件
	 * @return string 返回json字符串数据
	 */
	public function read($post = [])
	{
		// 获取搜索条件
		$where = '1';
		if (isset($post['search']['value']))
		{
			$where_temp = preg_replace('/\s+/', '', $post['search']['value']);
			$where .= " AND `title` like '%{$where_temp}%' ";
		}
		
		// 获取排序
		if (isset($post['order']))
		{
			$order = '`'.$post['columns'][$post['order'][0]['column']]['data'] . '` ' . $post['order'][0]['dir'];			
		}
		else 
		{
			$order = '`create_time` DESC';
		}
		
		// 获取分页
		$limit['offset'] = isset($post['start']) ? $post['start'] : 1;
		$limit['rows'] = isset($post['length']) ? $post['length'] : 10 ;
		
		// 返回基本信息
		$data['recordsTotal'] = $data['recordsFiltered'] = $this->where(['state'=>0])->where($where)->order($order)->limit($limit['offset'],$limit['rows'])->count();
		$data['draw'] = isset($post['draw']) ? $post['draw'] : 1;
		
		// 获取数据
		$res = $this->field('*,id edit')->where(['state'=>0])->where($where)->order($order)->limit($limit['offset'],$limit['rows'])->select(); 
		/**
		 * TODO 当数据为空的时候，页面会卡在 ‘加载中’。【待修复】
		 */		
		foreach ($res as $k => $v)
		{
			$data['data'][$k] = $v->hidden(['content'])->toArray();
		}
		return json_encode($data);
	}
	
	/**
	 * 通过ID查找单条数据
	 * @date 2017年1月9日
	 * @author Yexk
	 *
	 * @param string $id 主键ID	
	 * @return object 返回一个模型对象
	 */
	public function findOne($id = '') 
	{
		if (!$id) return null;
		
		$blog_mark = json_decode(Cookie::get('blog_mark'),true);
		$blog_mark = $blog_mark != null ? $blog_mark : [];  
		if (!in_array($id, $blog_mark))
		{
			$this->where(['id'=>$id])->setInc('read_num');
			array_push($blog_mark, $id);
			setcookie('blog_mark',json_encode($blog_mark),time()+30);
		}
	
		return $this->alias('a')->field('a.*,u.name username')->join('__USER__ u','u.id = a.user_id','LEFT')->where(['a.id'=>$id])->find();
	}

	/**
	 * 相关推荐
	 * 根据当前的id获取当当前分类，然后根据阅读数量进行倒叙去除3条
	 * @Author Yexk
	 * @Date   2017-02-10
	 * @param  Number     $id [当前文章的id]
	 * @return object         [返回一个模型对象]
	 */
	public function reconmend($id = '')
	{
		if (!$id && !is_numeric($id)) return null;

		return $this->query("SELECT id,title,thumb,create_time FROM ye_article WHERE cid = ( SELECT cid FROM `ye_article` WHERE id = {$id} ) ORDER BY ye_article.read_num DESC LIMIT 3");
	}

	
	/**
	 * 文章的新增和修改操作
	 * @date 2017年1月9日
	 * @author Yexk
	 *
	 * @param unknown $post 表单的数据
	 * @return number[]|string[] 返回状态信息
	 */
	public function write($post)
	{
		/* 
		 * cid:4
		   title:JS控制台的入门使用
		   desc:
		   content:#2121212 
		*/
		$post['title']   = trim($post['title']);
		$post['desc']    = trim($post['desc']);		
		$post['content'] = trim($post['content']);
		$post['user_id'] = Session::get('YE_UID');
		if (isset($post['id']))
		{
			$res = $this->isUpdate(true)->save($post,['id'=>$post['id']]);
			if (1 === $res)
			{
				return ['code'=>1,'msg'=>'修改成功！','data'=>''];
			}
			else
			{
				return ['code'=>0,'msg'=>'暂无修改','data'=>''];
			}
		}
		else
		{
			$res = $this->validate(TRUE)->save($post);
			if (1 === $res)
			{
				return ['code'=>1,'msg'=>'添加成功！','data'=>''];
			}
			else
			{
				return ['code'=>0,'msg'=>$this->getError(),'data'=>''];
			}
		}
	
	}
	
	/**
	 * 删除文章操作(伪删除)
	 * @date 2017年1月9日
	 * @author Yexk
	 *
	 * @param string $id 需要删除的文章ID
	 * @return NULL|number[]|string[] 返回状态信息
	 */
	public function del($id = '') 
	{
		if (!$id) return null;
		
		$res = $this->isUpdate(true)->save(['state'=>1],['id'=>$id]);
		if (1 === $res)
		{
			return ['code'=>1,'msg'=>'删除成功！','data'=>''];
		}
		else
		{
			return ['code'=>0,'msg'=>'未知错误','data'=>''];
		}
	}
	
	/**
	 * 默认获取三条热门的文章
	 * @date 2017年2月5日
	 * @author Yexk
	 *
	 * @param number $limit 获取的条数
	 */
	public function getHot($limit = 3)
	{
		return $this->field('id,title,thumb,create_time')->order('read_num Desc')->limit($limit)->select();
	}
	
	/**
	 * 默认获取四条最新的文章
	 * @date 2017年2月5日
	 * @author Yexk
	 *
	 * @param number $limit 默认的获取条数
	 */
	public function getNew($limit = 4) 
	{
		return $this->field('id,title,thumb,create_time')->order('create_time Desc')->limit($limit)->select();
	}
	
	/**
	 * 获取当前分类的所有列表
	 * @date 2017年2月5日
	 * @author Yexk
	 *
	 * @param unknown $post cid当前分类id
	 * @return number[]|string[]|number[]|string[]|unknown[]
	 */
	public function getCurrentCategoryArticle($post) 
	{
		if (!$post['cid']) return ['code'=>0,'msg'=>'未知错误！','data'=>''];
		
		$res = $this->field('id,title,thumb,create_time')->where(['cid'=>$post['cid']])->order('create_time Desc')->limit(1000)->select();
		if ($res)
		{
			return ['code'=>1,'msg'=>'获取成功！','data'=>$res];
		}
		else
		{
			return ['code'=>0,'msg'=>'暂无数据！！！','data'=>''];
		}
		
	}
	
	/**
	 * 更新赞的数量
	 * @date 2017年2月9日
	 * @author Yexk
	 *
	 * @param unknown $post 主键id
	 * @return number[]|string[] 返回处理结果
	 */
	public function setIncLikeNum($post) 
	{
		if (!$post['id']) return ['code'=>0,'msg'=>'未知错误！','data'=>''];
		
		$id = $post['id'];
		$blog_like_num = json_decode(Cookie::get('blog_like_num'),true);
		$blog_like_num = $blog_like_num != null ? $blog_like_num : [];
		if (!in_array($id, $blog_like_num))
		{
			$this->where(['id'=>$id])->setInc('like_num');
			array_push($blog_like_num, $id);
			setcookie('blog_like_num',json_encode($blog_like_num),time()+30);
			return ['code'=>1,'msg'=>'赞+1！','data'=>''];

		}else {
			return ['code'=>0,'msg'=>'你已经赞过了！','data'=>''];
		}

	}
	
}