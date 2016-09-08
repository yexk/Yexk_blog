<?php
/**
 * 用户模型的自动验证
 *
 * @author Yexk
 * @date 2016年8月30日
 */
namespace app\common\validate;

use think\Validate;

class User extends Validate
{

    protected $rule = [
            'username'  =>  'unique:user|require|max:25|min:4',
            'email' =>  'unique:user|email',
            'password' => 'min:4',
//     		'repassword'=>'require|confirm:password'
    ];
    
    protected $message = [
            'username'  =>  '用户名必须',
    		'username.unique' => '用户用已被注册!请重新选择！',
            'username.min'  =>  '用户名至少是四位数!',
            'email' =>  '邮箱格|式错误',
    		'email.unique' => '此邮箱已经被注册！',
            'password' => '密码至少是4位数!',
//     		'repassword' => '两次密码不一致！' 
    ];
    
}