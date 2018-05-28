<?php

namespace app\admin\controller;



class Webset extends Common
{
    //网站设置首页
    public function index(){
        return $this->fetch();
    }
}
