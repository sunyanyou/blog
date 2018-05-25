<?php
namespace app\admin\controller;

use app\admin\model\Admin;
use houdunwang\crypt\Crypt;
use think\controller;
use think\Request;

class Login extends controller {
	public function index(){

        //开始判断登录
		if(request()->ispost()){
		    $res = (new Admin())->login(input('post.'));
            if($res['valid']){
                $this->success($res['msg'],'admin/index/index');
            }
		}
		return $this->fetch();
	}

}