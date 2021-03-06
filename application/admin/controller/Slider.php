<?php

namespace app\admin\controller;

use think\Controller;

class Slider extends Controller
{
    protected $db;
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->db = new\app\admin\model\Slider();
    }

    //幻灯图片列表
    public function index(){
        $slider = db('slider')->paginate(10);
        $this->assign('slider',$slider);
        return $this->fetch();
    }
    //添加幻灯图片
    public function store(){
        if(request()->isPost()){
            $res = $this->db->store(input('post.'));
            if($res['valid']){
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }
        return $this->fetch();
    }
    //修改幻灯图片
    public function edit(){
        if(request()->isPost()){
            $res = $this->db->edit(input('post.'));
            if($res['valid']){
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }

        $slider_id = input('param.slider_id');
        //获取当前要编辑的文章数据
        $oldData = db('slider')->find($slider_id);
        $this->assign('oldData',$oldData);
        return $this->fetch();
    }
    //删除幻灯图片
    public function del(){

        $slider_id = input('param.slider_id');
        if(\app\admin\model\Slider::destroy($slider_id)){
            $this->success('删除焦点图成功','index');

        }else{
            $this->error('删除焦点图失败');
        }
    }
}
