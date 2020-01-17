<?php

class test
{
    public function index()
    {
        echo 'hello,word!';
    }
    public function read()
    {
        $arr = array(
            '0'=>array('id'=>1,'name'=>'tim'),
            '1'=>array('id'=>2,'name'=>'jike'),
            '3'=>array('id'=>3,'name'=>'蔡虚坤')
        );
        var_dump($arr);
    }
}