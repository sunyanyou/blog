<?php

namespace app\admin\controller;



class Article extends Common
{
    //文章列表
    public function index(){
        return $this->fetch();
    }
    //回收站
    public function recycle(){
        return $this->fetch();
    }
}
