<?php
/**
 * Created by PhpStorm.
 * User: sunyanyou
 * Date: 2018/7/14
 * Time: 下午4:03
 */
namespace app\admin\model;

use think\Model;

class Slider extends Model{
    protected $pk = 'slider_id';
    protected $table = 'blog_slider';

    protected $insert = ['slidertime'];

    protected function setSliderTimeAttr($value){
        return time();
    }

    //添加焦点图片
    public function store($data){
        $result = $this->validate(true)->allowField(true)->save($data);
        if ($result){
            return ['valid'=>1,'msg'=>'添加焦点图成功'];
        }else{
            return ['valid'=>0,'msg'=>$this->getError()];
        }
    }
    //修改焦点图片
    public function edit($data){
        $res = $this->validate(true)->allowField(true)->save($data,[$this->pk=>$data['slider_id']]);
        if($res){
            return ['valid'=>1,'msg'=>'焦点图片修改成功'];
        }else{
            return ['valid'=>0,'msg'=>$this->getError()];
        }
    }

}