<?php
namespace app\admin\controller;
use think\controller;

class Welcome extends Common {
	public function welcome(){
        return $this->fetch();
	}
}