<?php

namespace app\index\controller;

use think\Controller;
use think\Request;

class Common extends Controller
{
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        //读取网站配置项
        $webset = $this->loadWebSet();
        $this->assign('_webset',$webset);
        //获取顶级栏目数据
        $cateData = $this->loadCateData();
        $this->assign('_CateData',$cateData);
        //获取友情链接
        $linkData = $this->loadLinkData();
        $this->assign('_LinkData',$linkData);
    }
    //读取配置项
    private function loadWebSet(){
        return db('webset')->column('webset_value','webset_name');
    }
    //获取友情链接数据
    private function loadLinkData(){
        return db('link')->order('link_sort desc')->select();
    }
    //获取顶级栏目数据
    private function loadCateData(){
        return db('category')->where('cate_pid',0)->order('cate_sort desc')->limit(3)->select();
    }
}
