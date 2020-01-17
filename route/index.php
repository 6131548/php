<?php
//访问url http://demo.php.com/index.php/test/read
$uri = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));//解析url,并且转为数组
// var_dump($uri);
$class = $uri[2];//默认index.php入口，所以选择2
$path = './controller/'.$class.'.php';

if(file_exists($path)) {//判断文件是否存在
    require $path;
    $object = new $class();//实例化
    $action = !empty($uri[3])?$uri[3] : 'index';//判断是数组否存在
    if(method_exists($object,$action)) {//判断该类方法是否存在
        $parameter = !empty($uri[4])?$uri[4] : 'null';
        call_user_func_array(array($object, $action), array($parameter)); //调用对象里的方法并传参，call_user_func_array调用回调函数
    } else {
        echo "{$class}模块下不存在{$action}方法";
    }
} else {
    echo "{$class}模块不存在";
}