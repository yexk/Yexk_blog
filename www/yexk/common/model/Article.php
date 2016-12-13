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
			return $res;
		}
	}
}