<?php
namespace app\admin\model;
use houdunwang\arr\Arr;
use think\model;

class Category extends Model{
    protected $pk = 'cate_id';
    protected $table = 'blog_category';
    //获取栏目树状结构
    public function getAll(){
        return Arr::tree(db('category')->order('cate_sort desc,cate_id')->select(), 'cate_name', $fieldPri = 'cate_id',
            $fieldPid = 'cate_pid');
    }
    //添加栏目
    public function store($data){
        //执行添加
        $result = $this->validate(true)->save($data);
        //添加失败，输出错误消息
        if(false === $result){
            return ['valid'=>0,'msg'=>$this->getError()];
        }else{
            return ['valid'=>1,'msg'=>'栏目添加成功'];
        }
    }
    public function getCateData($cate_id)
    {
        //halt(db('cate')->select());
        //1.首先找到$cate_id子集
        $cate_ids = $this->getSon(db('category')->select(),$cate_id);
        //2.将自己追加进去
        $cate_ids[] = $cate_id;
        //dump($cate_ids);
        //3.找到除了他们之外的数据,病变成树状结构
        $field = db('category')->whereNotIn('cate_id',$cate_ids)->select();
        return Arr::tree($field,'cate_name','cate_id','cate_pid');
        //halt($field);
    }
    /**
     * 找子集
     */
    public function getSon($data,$cate_id)
    {
        static $temp = [];
        foreach($data as $k=>$v)
        {
            if($cate_id==$v['cate_pid'])
            {
                $temp[] = $v['cate_id'];
                $this->getSon($data,$v['cate_id']);
            }
        }
        return $temp;
    }
    /**
     * 编辑栏目
     */
    public function edit($data)
    {
        //cate_id=10
        $result = $this->validate(true)->save($data,[$this->pk=>$data['cate_id']]);
        if($result)
        {
            //执行成功
            return ['valid'=>1,'msg'=>'编辑成功'];
        }else{
            return ['valid'=>0,'msg'=>$this->getError()];
        }
    }
    //删除栏目
    public function del($cate_id){
        //获取当前要删除数据的cate_pid
        $cate_pid = $this->where('cate_id',$cate_id)->value('cate_pid');

        //将当前要删除的$cate_id的子栏目的pid修改成$cate_pid
        $this->where('cate_pid',$cate_id)->update(['cate_pid'=>$cate_pid]);
        //执行删除栏目
        if(Category::destroy($cate_id)){
            return ['valid'=>1,'msg'=>'栏目删除成功'];
        }else{
            return ['valid'=>0,'msg'=>'栏目删除失败'];
        }
    }
}