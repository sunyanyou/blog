<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;


class Common extends controller{
	public function __construct( Request $request = null){
		parent::__construct($request);
		if(!session('admin.admin_id')){
			$this->redirect('admin/Login/index');
		}
	}
}

