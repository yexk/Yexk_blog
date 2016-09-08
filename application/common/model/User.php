<?php
/**
 * User表
 * 用户模型
 * @author Yexk
 * @date 2016年8月26日
 */
namespace app\common\model;

use think\Model;
use think\Validate;
use think\Db;

class User extends Model
{
	protected $autoWriteTimestamp = true;
	protected $createTime = 'reg_time';
	protected $updateTime = 'login_time';
	// 自动插入状态为1
	protected $insert = ['status'=>1];
	
	/**
	 * 模型的注册方法
	 * @date 2016年9月8日
	 * @author Yexk
	 *
	 * @param array $post
	 * @return boolean|number
	 *
	 */
	public function register($post) 
    {
    	/*
    	 * array(5) {
    	 ["email"] => string(9) "121@es.cn"
    	 ["username"] => string(3) "123"
    	 ["password"] => string(4) "1212"
    	 ["repassword"] => string(4) "1212"
    	 ["checkbox"] => string(2) "on"
    	 }
    	 */
		if (empty($post['checkbox']) || $post['checkbox'] !== 'on')
		{
			$this->error = "请先查看服务条款";
			return false;
		}
		if ($post['password'] !== $post['repassword'])
		{
			$this->error = '两次的密码不一致，请重新输入！';
			return false;
		}
		unset($post['checkbox']);
		unset($post['repassword']);
		$post['password'] = md5($post['password']);
		$res = $this->validate(true)->save($post);
    	return $res;
    }
    
    /**
     * 登陆检测
     * @date 2016年9月8日
     * @author Yexk
     *
     * @param unknown $post
     * @return boolean|unknown
     *
     */
    public function checkLogin($post)
    {
    	if (empty($post))
    	{
    		$this->error = "数据异常！";
    		return FALSE;
    	}
    	if (Validate::is($post['log_username'],'email'))
    	{
	    	$res = $this->where("email = '$post[log_username]'")->find();
// 			$res = Db::name('user')->where("email=")
    	}
    	else 
    	{    		
	    	$res = $this->where("username = '$post[log_username]'")->find();
    	}
    	if ($res)
    	{
    		if (md5($post['log_password']) === $res['password'])
    		{
    			// 登陆成功
    			unset($res['password']);
    			session('admin_uid',$res['id']);
    			session('admin_message',$res);
    			return TRUE;
    		}
    	}
    	$this->error = "登陆失败！";
    	return $res;
    }
    
	public function logout()
	{
		// 清除session
		session(null);
		cookie(null);
	}
}