<?php

function conf($key)
{
    $conf = array(

        "redis-host"=>'119.29.155.89',//'127.0.0.1',
        "redis-port"=>6379,
        "redis_pwd"=>"04DB430DB0B562ED9FFDE7144D75195B",/**/


        'default_module' =>'Home', //Ĭ��ģ��
        'default_controller' =>'Index', //Ĭ�Ͽ�����
        'default_action' =>'index', //Ĭ�Ͽ�����
        'module_list' =>"Home,", //����ģ���б�
    );


    return $conf[$key];

}

