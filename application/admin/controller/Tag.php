<?php

namespace app\admin\controller;


class Tag extends Common
{
    //标签首页
    public function index(){
        return $this->fetch();
    }
    //添加标签
    public function store(){
        return $this->fetch();
    }
}
