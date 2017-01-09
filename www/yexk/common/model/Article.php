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
		
		return $this->where(['id'=>$id])->find();
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
	
}