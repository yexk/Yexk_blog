<?php
namespace app\common\model;

use think\Model;
use think\Session;

class User extends Model
{
	/**
	 * 检查用户登陆的信息是否正确
	 * @date 2017年1月9日
	 * @author Yexk
	 *
	 * @param unknown $post 表单信息
	 * @return number[]|string[] 
	 */
	public function checkLogin($post)
	{
		if (isset($post['do_login']) && isset($post['__token__']) && $post['__token__'] === Session::get('__token__'))
		{
			if(isset($post['username']) && isset($post['password']))
			{
				$user_info = $this->where(['username' => $post['username'],'state' => 0])->find();
				if ($user_info)
				{
					if ($user_info->password === md5($post['password']))
					{
						// 登陆成功!
						unset($user_info['password']);
						Session::set('YE_INFO',$user_info);
						Session::set('YE_UID',$user_info['id']);
						
						return ['code'=>1,'msg'=>'登陆成功！','data'=>''];
					}
				}else
				{
					return ['code'=>0,'msg'=>'输入的用户信息不匹配！','data'=>''];
				}
			}else 
			{
				return ['code'=>0,'msg'=>'未知错误！','data'=>''];
			}
		}
		else 
		{
			return ['code'=>0,'msg'=>'未知错误！','data'=>''];
		}
	}
}