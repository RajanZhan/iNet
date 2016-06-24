<?php

use \Model;
use \GatewayWorker\Lib\Gateway;
/*ÉèÖÃ»º´æ*/
function C($key,$value ="",$time='')
{
    $redis =  Model\redis::getInstance();
    if(empty($value))
    {
        return $redis->get($key);
    }
    else
    {
        if(empty($time))
        {

            $redis->set($key,$value);
            echo $key.":".$value;
        }
        else
        {
            $redis->setex($key,$time,$value);
            echo $key.$value;
        }
    }

}

function sendToCurrent($msg)
{
    if(is_array($msg))
    {
        $msg = json_encode($msg);
    }
    Gateway::sendToCurrentClient($msg);
}