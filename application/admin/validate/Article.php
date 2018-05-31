<?php
namespace app\admin\validate;

use think\Validate;

class Article extends Validate{
    protected $rule = [
        'arc_title' => 'require',
        'arc_author' => 'require',
        'arc_sort' => 'require|number|between:1,999',
        'cate_id' => 'notIn:0',
        'arc_thumb' => 'require',
        'arc_digest' => 'require',
        'arc_content' => 'require'
    ];
    protected $message = [
        'arc_title.require' => '请填写文章标题',
        'arc_author.require' => '请填写文章作者',
        'arc_sort.require'  => '请填写文章排序',
        'arc_sort.number'   => '文章排序必须是数字',
        'arc_sort.between'  => '文章排序必须在1-999之间',
        'cate_id.notIn'     => '请选择文章分类',
        'arc_thumb.require' => '请上传文章图片',
        'arc_digest.require'=> '请填写文章摘要',
        'arc_content.require'=> '请填写文章内容'

    ];
}