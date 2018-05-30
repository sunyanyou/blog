<?php
namespace app\admin\validate;

use think\Validate;

class Link extends Validate{
    protected $rule = [
        'link_name'=>'require',
        'link_url'=>'require',
        'link_sort'=>'require|number|between:1,9999'
    ];
    protected $message = [
        'link_name.require'=>'友情链接名称必须填写',
        'link_url.require'=>'链接地址必须填写',
        'link_sort.require'=>'链接排序必须填写',
        'link_sort.number'=>'链接排序必须是数字',
        'link_sort.between'=>'排序数字必须在1-9999之间'
    ];

}