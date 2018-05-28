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


    public function login($data)
    {
        //1.执行验证
        $validate = Loader::validate('Admin');
        //如果验证不通过
        if(!$validate->check($data)){
            return ['valid'=>0,'msg'=>$validate->getError()];
        }
        //2.比对用户名和密码是否正确
        $userInfo = $this->where('admin_username',$data['admin_username'])->where('admin_password',Crypt::encrypt($data['admin_password']))->find();
        //halt($userInfo);
        if(!$userInfo)
        {
            //说明在数据库未匹配到相关数据
            return ['valid'=>0,'msg'=>'用户名或者密码不正确'];
        }
        //3.将用户信息存入到session中
        session('admin.admin_id',$userInfo['admin_id']);
        session('admin.admin_username',$userInfo['admin_username']);
        return ['valid'=>1,'msg'=>'登录成功'];
    }
    //修改密码
    public function pass($data){
        //执行验证
        $validate = new Validate([
            'admin_password'    => 'require',
            'new_password'      => 'require',
            'confirm_password'  =>  'require|confirm:new_password'
        ],[
            'admin_password.require'=>'请输入原始密码',
            'new_password.require'  =>'请输入新密码',
            'confirm_password.require'=>'请输入确认密码',
            'confirm_password.confirm'=>'确认密码和新密码不一致'
        ]);
        if(!$validate->check($data)){
            return ['valid'=>0,'msg'=>$validate->getError()];
        }
        //比对输入的原始密码是否与数据库中的原始密码一致
        $userInfo = $this->where('admin_id',session('admin.admin_id'))->where('admin_password',Crypt::encrypt($data['admin_password']))->find();
        if(!$userInfo){
            return ['valid'=>0,'msg'=>'原始密码输入不正确'];
        }
        //修改密码
        $res = $this->save([
            'admin_password'    => Crypt::encrypt($data['new_password']),
        ],[$this->pk=> session('admin.admin_id')]);
        if($res){
            return ['valid'=>1,'msg'=>'密码修改成功'];
        }else{
            return ['valid'=>0,'msg'=>'密码修改失败'];
        }

    }
}