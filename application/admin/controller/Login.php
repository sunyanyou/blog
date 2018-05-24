<?php
namespace app\admin\controller;
use think\controller;

class Login extends controller {
	public function index(){
		return $this->fetch();
	}
}