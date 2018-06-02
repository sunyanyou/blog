<?php
namespace app\index\controller;
use think\controller;
class Index extends Controller
{
    public function index()
    {

        return $this->fetch();

    }
}
