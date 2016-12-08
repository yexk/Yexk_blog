<?php
/**
 * 文章分类模型
 * 处理文章分类列表
 * @author Yexk
 * @date 2016年12月1日
 */
namespace app\common\model;

use think\Model;

class Category extends Model
{
	/**
	 * 添加数据
	 * @date 2016年12月5日
	 * @author Yexk
	 *
	 * @param  Array $post 表单传入的数据
	 * @return Array       返回状态信息
	 */
	public function write($post) 
	{
		/*  pid:0
			name:12312123
			desc:12313 */
		if (empty($post['name']))
		{
			return ['code'=>0,'msg'=>'名称不能为空！','data'=>''];
		}
		$post['name'] = trim($post['name']);
		$post['desc'] = trim($post['desc']);
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
			$res = $this->save($post);
			if (1 === $res)
			{
				return ['code'=>1,'msg'=>'添加成功！','data'=>''];
			}
			else
			{
				return ['code'=>0,'msg'=>'未知错误！','data'=>''];
			}
		}
		
	}
	
	/**
	 * 读取数据
	 * @date 2016年12月5日
	 * @author Yexk
	 *
	 * @param array $post 当传入id的时候获取的是一条数据
	 * @return Array      返回数据
	 */
	public function read($post = [])
	{
		$res = $this->all();
		if (!empty($post['id']))
		{
			$data['all'] = get_tree($res,$post['pid']);
			$data['one'] = $this->get(['id'=>$post['id']]);
			return $data;
		}	
		else 
		{
			return get_tree($res);
		}
	}
}