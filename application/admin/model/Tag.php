<?php
namespace app\admin\model;

use think\Model;

class Tag extends Model{
    protected $pk = 'tag_id';
    protected $table = 'blog_tag';
    //添加标签
    public function store($data){
        $result = $this->validate(true)->save($data);
        if($result){
            return ['valid'=>1,'msg'=>'标签添加成功'];
        }else{
            return ['valid'=>0,'msg'=>'标签添加失败'];
        }
    }
}