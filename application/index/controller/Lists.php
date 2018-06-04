<?php

namespace app\index\controller;


class Lists extends Common
{
    public function index(){
        return $this->fetch();
    }
}
