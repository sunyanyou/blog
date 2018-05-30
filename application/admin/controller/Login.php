<?php
namespace app\admin\controller;

use app\admin\model\Admin;
use houdunwang\crypt\Crypt;
use think\controller;
use think\Request;
use think\session;

//class Login extends Controller {
//	public function index(){
//
//        //开始判断登录
//		if(request()->ispost()){
//		    $res = (new Admin())->login(input('post.'));
//            if($res['valid']){
//                $this->success($res['msg'],'admin/index/index');
//            }
//		}
//		return $this->fetch();
//	}
//    //退出登录
//    public function logout(){
//	    session::clear();
//	    $this->success('退出登录','admin/login/index');
//    }
//}
class Login extends Controller
{


    public function index()
    {

        if(request()->isPost()){
            $res = (new Admin())->login(input('post.'));
            if($res['valid'])
            {
                //说明登录成功
                $this->success($res['msg'],'admin/index/index');
            }else{
                //说明登录失败
                $this->error($res['msg']);
            }
        }
        //加载我们登录页面
        return $this->fetch('index');
    }
    //退出登录
    public function logout(){
        Session::clear();
        $this->success('退出登录','admin/login/index');
    }
}