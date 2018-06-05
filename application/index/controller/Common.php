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
        $this->assign('_cateData',$cateData);
        //获取全部栏目数据
        $allCateData = $this->loadAllCateData();
        $this->assign('_allCateData',$allCateData);
        //获取标签数据
        $tagData = $this->loadTagData();
        $this->assign('_tagData',$tagData);
        //最新文章
        $articleData = $this->loadArticleData();
        $this->assign('_articleData',$articleData);
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
        return db('category')->where('cate_pid',0)->order('cate_sort asc')->limit(6)->select();
    }
    //获取全部栏目数据
    private function loadAllCateData(){
        return db('category')->order('cate_sort desc')->select();
    }
    //获取最新文章
    private function loadArticleData(){
        return db('article')->order('sendtime desc')->limit(7)->select();
    }
    //获取标签数据
    private function loadTagData(){
        return db('tag')->select();
    }
}
