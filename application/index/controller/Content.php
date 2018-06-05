<?php

namespace app\index\controller;



class Content extends Common
{
    public function index(){
        $arc_id = input('param.arc_id');
        //文章点击次数+1
        db('article')->where('arc_id',$arc_id)->setInc('arc_click');
        $articleData = db('article')->find($arc_id);
        $headConf = ['title'=>"个人博客--{$articleData['arc_title']}"];
        $this->assign('headConf',$headConf);
        //当前文章标签
        $articleData['tags'] = db('arc_tag')->alias('at')->join('__TAG__ t','at.tag_id=t.tag_id')->where('at.arc_id',
            $articleData['arc_id'])->field('t.tag_id,t.tag_name')->select();
        $this->assign('articleData',$articleData);
        return $this->fetch();
    }
}
