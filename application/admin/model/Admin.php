<?php
namespace app\admin\model;

use houdunwang\crypt\Crypt;
use think\Loader;
use think\Model;
use think\Validate;

class Admin extends Model
{
    protected $pk = 'admin_id';  //主键
    //设置当前模型对应的完整数据表名称
    protected $table = 'blog_admin';
    //开始登录
    public function login($data){
        //进行验证用户名、密码和验证码是否为空
        $validate = Loader::validate('Admin');
        //如果为空
        if(!$validate->check($data)){
            return ['valid'=>0,'msg'=>$validate->getError()];
        }
        //比对用户名和密码是否和数据库中的相同
        $userInfo = $this->where('admin_username',$data['admin_username'])->where('admin_password',Crypt::encrypt
        ($data['admin_password']))->find();


        //如果与数据库中的数据不匹配
        if(!$userInfo){
            return ['valid'=>0,'msg'=>'用户名或者密码不正确'];
        }
        //将用户信息存入到session中
        session('admin.admin_id',$userInfo['admin_id']);
        session('admin.admin_username',$userInfo['admin_username']);
        return ['valid'=>1,'msg'=>'登录成功'];

    }

}