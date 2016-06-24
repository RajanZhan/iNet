<?php

function conf($key)
{
    $conf = array(

        "redis-host"=>'119.29.155.89',//'127.0.0.1',
        "redis-port"=>6379,
        "redis_pwd"=>"04DB430DB0B562ED9FFDE7144D75195B",/**/


        'default_module' =>'Home', //默认模块
        'default_controller' =>'Index', //默认控制器
        'default_action' =>'index', //默认控制器
        'module_list' =>"Home,", //开放模块列表
    );


    return $conf[$key];

}

