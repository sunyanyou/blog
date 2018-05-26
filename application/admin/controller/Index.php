<?php
namespace app\admin\controller;

class Index extends Common
{
    //后台首页
    public function index()
    {
        return $this->fetch();
    }

}
