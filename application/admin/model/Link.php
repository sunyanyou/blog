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
//        $res = $this->validate(true)->save($data,$data['link_id']);
        $result = $this->validate(true)->save($data);
        if ($result){
            return ['valid'=>1,'msg'=>'添加友情链接成功'];
        }else{
            return ['valid'=>0,'msg'=>$this->getError()];
        }
    }
    //编辑友情链接
    public function edit($data){
        $result = $this->validate(true)->save($data,[$this->pk=>$data['link_id']]);

        if($result){
            return ['valid'=>1,'msg'=>'友情链接编辑成功'];
        }else{
            return ['valid'=>0,'msg'=>$this->getError($data)];
        }
    }
}