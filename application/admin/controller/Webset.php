<?php

namespace app\admin\controller;



class Webset extends Common
{
    //网站设置首页
    public function index(){
        $list = db('webset')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }
    //修改网站设置

    public function edit(){
        if(request()->isAjax()){
            $res = (new \app\admin\model\Webset())->edit(input('post.'));
            if($res['valid']){
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }
    }
}
