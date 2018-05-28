<?php
namespace app\admin\controller;
use app\admin\model\Admin;
class Index extends Common
{
    //后台首页
    public function index()
    {
        return $this->fetch();
    }
    //管理员修改密码
    public function changepass(){
        if(request()->isPost()){
            $res = (new Admin())->pass(input('post.'));
            if($res['valid']){
                //清除session中的登录信息
                session(null);
                //密码更新成功
                $this->success($res['msg'],'admin/index/index');
            }else{
                $this->error($res['msg']);
            }
        }
        return $this->fetch();
    }

}
