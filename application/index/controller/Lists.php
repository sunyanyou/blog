<?php

namespace app\index\controller;


use app\admin\model\Category;

class Lists extends Common
{
    public function index(){

        //获取左侧第一部分数据
        $cate_id = input('param.cate_id');
        $tag_id = input('param.tag_id');
        if ($cate_id){
            //当前分类所有子集分类id
            $cids = (new Category())->getSon(db('category')->select(),$cate_id);
            $cids = $cate_id;
            $headData = [
                'title' => '分类',
                'name' =>db('category')->where('cate_id',$cate_id)->value('cate_name'),
                'total' =>db('article')->whereIn('cate_id',$cids)->count(),
            ];
            //获取文章数据
            $articleData = db('article')->alias('a')->join('__CATEGORY__ c','a.cate_id=c.cate_id')->where('a.is_recycle',
                    2)->whereIn('a.cate_id',$cids)->select();
        }

        if($tag_id){
            $headData = [
                'title' => '标签',
                'name' => db('tag')->where('tag_id',$tag_id)->value('tag_name'),
                'total' => db('arc_tag')->where('tag_id',$tag_id)->count(),
            ];
            //获取文章数据
            $articleData = db('article')->alias('a')
                ->join('__ARC_TAG__ at','a.arc_id=at.arc_id')
                ->join('__CATEGORY__ c','a.cate_id=c.cate_id')
                ->where('a.is_recycle',2)->where('at.tag_id',$tag_id)->select();


        }
        foreach ($articleData as $k=>$v){
            $articleData[$k]['tags'] = db('arc_tag')->alias('at')->join('__TAG__ t','at.tag_id=t.tag_id')->where('at.arc_id',$v['arc_id'])->field('t.tag_id,t.tag_name')->select();
        }

        $this->assign('headData',$headData);
        $headConf = ['title'=>"个人博客--{$headData['name']}"];
        $this->assign('headConf',$headConf);
        $this->assign('articleData',$articleData);
        return $this->fetch();
    }
}
