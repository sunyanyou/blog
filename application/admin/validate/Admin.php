<?php
/**
 * Created by PhpStorm.
 * User: sunyanyou
 * Date: 2018/5/25
 * Time: 下午3:59
 */

namespace app\admin\validate;
use think\Validate;

class Admin extends Validate{

    protected $rule = [
        'admin_username' => 'require',
        'admin_password' => 'require',
        'code' => 'require|captcha'
    ];

    protected $message = [
        'admin_username.require'=>'请输入用户名',
        'admin_password.require'=>'请输入密码',
        'code.require'=>'请输入验证码',
        'code.captcha'=>'验证码不正确'
    ];

}