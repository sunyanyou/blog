<?php

namespace app\admin\controller;


class Category extends Common
{
    //栏目列表
    public function index(){
        return $this->fetch();
    }
    //添加栏目
    public function store(){
        return $this->fetch();
    }
}
