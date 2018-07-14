<?php
/**
 * Created by PhpStorm.
 * User: sunyanyou
 * Date: 2018/7/14
 * Time: 下午3:57
 */
namespace app\admin\validate;

use think\Validate;

class Slider extends Validate{
    protected $rule = [
        'slider_title' => 'require',
        'slider_url'   => 'require',
        'slider_sort' => 'require|number|between:1,999',
        'slider_thumb' => 'require'
    ];
    protected $message = [
        'slider_title.require'  => '标题必须填写',
        'slider_url.require'    => 'url地址必须填写',
        'slider_sort.require'   => '排序必须填写',
        'slider_sort.number'    => '排序必须使用数字',
        'slider_sort.between'   => '排序需要在1-999之间',
        'slider_thumb.require'  => '图片不能为空'
    ];
}