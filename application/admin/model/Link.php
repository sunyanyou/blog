<?php
namespace app\admin\model;
use think\model;

class Link extends Model{

    protected $pk = 'link_id';
    protected $table = 'blog_link';

    //获取数据表中的友情链接数据
    public function getAll(){
        return $this->order('link_sort desc','link_id desc')->paginate(10);

    }
    //添加友情链接
    public function store($data){
        $res = $this->validate(true)->save($data,$data['link_id']);
        if ($res){
            return ['valid'=>1,'msg'=>'操作成功'];
        }else{
            return ['valid'=>0,'msg'=>$this->getError()];
        }
    }
}