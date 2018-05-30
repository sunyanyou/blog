<?php

namespace app\admin\controller;


class Tag extends Common
{
    protected $db;
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->db = new \app\admin\model\Tag();
    }

    //标签首页
    public function index(){
        $tags = db('tag')->paginate(5);
        $page = $tags->render();
        $this->assign('tags',$tags);
        $this->assign('page',$page);
        return $this->fetch();

    }
    //添加标签
    public function store(){
        $tag_id = input('param.tag_id');
        if(request()->isPost()){
            $res = $this->db->store(input('post.'));
            if($res['valid']){
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }
        if($tag_id){
            $oldData = $this->db->find($tag_id);
        }else{
            $oldData = ['tag_name'];
        }
        $this->assign('oldData',$oldData);
        return $this->fetch();
    }

    //删除标签
    public function del(){
        $tag_id = input('param.tag_id');
        //删除
        if(\app\admin\model\Tag::destroy($tag_id)){
            $this->success('标签删除成功','index');
        }else{
            $this->error('标签删除失败');
        }

    }
}