<?php

namespace app\admin\controller;
use app\admin\model\Category;


class Article extends Common
{
    protected $db;
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->db = new \app\admin\model\Article();
    }

    //文章列表
    public function index(){
        $list = $this->db->getAll(2);
        $this->assign('list',$list);
        return $this->fetch();
    }
    //添加文章
    public function store(){
        if(request()->isPost()){

            $res = $this->db->store(input('post.'));
            if($res['valid']){
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }
        $cateData = (new \app\admin\model\Category())->getAll();
        $this->assign('cateData',$cateData);
        $tagData = db('tag')->select();
        $this->assign('tagData',$tagData);
        return $this->fetch();
    }
    //修改文章
    public function edit(){
        if(request()->isPost()){
            $res = $this->db->edit(input('post.'));
            if($res['valid']){
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }

        $arc_id = input('param.arc_id');
        //获取分类数据
        $cateData = (new Category())->getAll();
        $this->assign('cateData',$cateData);
        //获取标签数据
        $tagData = db('tag')->select();
        $this->assign('tagData',$tagData);
        //获取当前要编辑的文章数据
        $oldData = db('article')->find($arc_id);
        $this->assign('oldData',$oldData);
        //获取当前文章所有标签id
        $tag_ids = db('arc_tag')->where('arc_id',$arc_id)->column('tag_id');
        $this->assign('tag_ids',$tag_ids);

        return $this->fetch();

    }
    //修改排序
    public function changeSort(){
        if(request()->isAjax()){
            $res = $this->db->changeSort(input('post.'));
            if ($res['valid']){
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }
    }
    //回收站
    public function recycle(){
        $list = $this->db->getAll(1);
        $this->assign('list',$list);
        return $this->fetch();
    }
    //删除文章到回收站
    public function delToRecycle(){
        $arc_id = input('param.arc_id');
        //is_recycle为1，代表文章在回收站中
        if($this->db->save(['is_recycle'=>1],['arc_id'=>$arc_id])){
            $this->success('操作成功','index');
        }else{
            $this->error('操作失败');
        }
    }
    //从回收站中恢复文章
    public function outToRecycle(){
        $arc_id = input('param.arc_id');
        if($this->db->save(['is_recycle'=>2],['arc_id'=>$arc_id])){
            $this->success('恢复数据成功','index');
        }else{
            $this->error('恢复数据失败');
        }
    }
    //从回收站中彻底删除文章
    public function del(){
        $arc_id = input('param.arc_id');
        $res = $this->db->del($arc_id);
        if($res['valid']){
            $this->success($res['msg'],'index');
        }else{
            $this->error($res['msg']);
        }
    }
}
