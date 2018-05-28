<?php

namespace app\admin\controller;


class Link extends Common
{
    //友情链接首页
    public function index(){
        return $this->fetch();
    }
}
