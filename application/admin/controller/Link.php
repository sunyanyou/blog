<?php

namespace app\admin\controller;


class Link extends Common
{
    protected $db;
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->db = new \app\admin\model\Link();
    }

    //友情链接首页
    public function index(){

        $field = $this->db->getAll();
        $this->assign('field',$field);
        return $this->fetch();
    }

    //添加友情链接
    public function store(){
        $link_id = input('param.link_id');
        if(request()->isPost()){
            $res = $this->db->store(input('post.'));
            if ($res['vailid']){
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }
        if ($link_id){
            //编辑
            $oldData = $this->db->find($link_id);
        }else{
            //添加
            $oldData = ['link_name'=>'','link_url'=>'','link_sort'=>100];
        }
        $this->assign('oldData',$oldData);
        return $this->fetch();
    }
    //友情链接删除
    public function del(){
        $link_id = input('get.link_id');
        if(\app\admin\model\Link::destroy($link_id)){
            $this->success('友情链接删除成功','index');
        }else{
            $this->error('友情链接删除失败');
        }
    }
}
