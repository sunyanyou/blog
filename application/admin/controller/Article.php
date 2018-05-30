<?php

namespace app\admin\controller;



class Article extends Common
{
    //文章列表
    public function index(){
        return $this->fetch();
    }
    //添加文章
    public function store(){
        $cateData = (new \app\admin\model\Category())->getAll();
        $this->assign('cateData',$cateData);
        $tagData = db('tag')->select();
        $this->assign('tagData',$tagData);
        return $this->fetch();
    }
    //回收站
    public function recycle(){
        return $this->fetch();
    }
}
