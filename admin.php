<?php

header('Content-Type:text/html;charset=utf-8');
if(version_compare(PHP_VERSION, '5.5.0','<')) die('PHP版本过低，最少需要PHP5.5，请升级PHP版本');

define('APP_PATH', __DIR__ . '/../application/');


require __DIR__ . 'thinkphp/start.php';

\think\Build::moudle('admin');