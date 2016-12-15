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

class Article extends Model
{
	// 自动写入时间戳
	protected $autoWriteTimestamp = TRUE;
	// 最懂数据类型转换
	protected $type = [
		'create_time'  =>  'timestamp:Y-m-d H:i:s',
	];
	
	public function read($post = [])
	{
		$data['recordsTotal'] = $data['recordsFiltered'] = $this->count();
		
		$res = $this->field('*,id edit')->select(); 
		foreach ($res as $k => $v)
		{
			$data['data'][$k] = $v->hidden(['content'])->toArray();
		}
		
		return json_encode($data);
		
		exit;
		if (!isset($post['id']))
		{
// 			$data['all'] = get_tree($res,$post['pid']);
// 			$data['one'] = $this->get(['id'=>$post['id']]);
// 			return $data;
		}
		else
		{
		}
	}
	
	
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
		// TODO 做完登陆后继续完善
		$post['user_id'] = 1;
		if (isset($post['id']))
		{
// 			$res = $this->isUpdate(true)->save($post,['id'=>$post['id']]);
// 			if (1 === $res)
// 			{
// 				return ['code'=>1,'msg'=>'修改成功！','data'=>''];
// 			}
// 			else
// 			{
// 				return ['code'=>0,'msg'=>'暂无修改','data'=>''];
// 			}
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
	
	
}