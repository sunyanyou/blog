<?php
namespace app\admin\model;

use think\Model;

class Article extends Model{
    protected $pk = 'arc_id';
    protected $table = 'blog_article';
    //字段内容自动填充
    protected $auto = ['admin_id'];
    protected $insert = ['sendtime'];
    protected $update = ['updatetime'];

    protected function setAdminIdAttr($value){
        return session('admin.admin_id');
    }
    protected function setSendTimeAttr($value){
        return time();
    }
    protected function setUpdateTimeAttr($value){
        return time();
    }

    //获取数据库文章数据
    public function getAll ($is_recycle)
    {
        return db( 'article' )->alias( 'a' )->join( '__CATEGORY__ c' , 'a.cate_id=c.cate_id' )->where( 'a.is_recycle' ,
            $is_recycle )->field( 'a.arc_id,a.arc_title,a.arc_author,a.sendtime,c.cate_name,a.arc_sort' )->order( 'a.arc_sort desc,a.sendtime desc,a.arc_id desc' )->paginate( 2 );
    }
    //添加文章
    public function store($data){
        //选择标签的验证，其实没有必要，标签应该不是必选
//        if(!isset($data['tag'])){
//            return ['valie'=>0,'msg'=>'请选择标签'];
//        }
        $result = $this->validate(true)->allowField(true)->save($data);
        if($result){
            //文章标签中间表添加

            foreach ($data['tag'] as $v){
                $arcTagData = [
                    'arc_id' => $this->arc_id,
                    'tag_id' => $v,
                ];

                (new ArcTag())->save($arcTagData);
            }
            return ['valid'=>1,'msg'=>'文章添加成功'];

        }else{
            return ['valid'=>0,'msg'=>$this->getError()];
        }
    }
}