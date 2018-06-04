<?php
namespace app\index\controller;

class Index extends Common
{
    public function index()
    {
        $headConf = ['title'=>'个人博客--首页'];
        $this->assign('headConf',$headConf);
        //获取文章
        $articleData = db('article')->alias('a')->join('__CATEGORY__ c','a.cate_id=c.cate_id')->where('a.is_recycle',
                2)->order('sendtime desc')->select();
        foreach ($articleData as $k=>$v){
            $articleData[$k]['tags'] = db('arc_tag')->alias('at')->join('__TAG__ t','at.tag_id=t.tag_id')->where('at.arc_id',$v['arc_id'])->field('t.tag_id,t.tag_name')->select();
        }
        $this->assign('articleData',$articleData);
        return $this->fetch();

    }
}
