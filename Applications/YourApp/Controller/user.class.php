<?php
/**
 * Created by PhpStorm.
 * User: Rajan
 * Date: 2016/3/29
 * Time: 15:03
 */

namespace Controller;
use \GatewayWorker\Lib\Gateway;
use \Workerman\Lib\Timer;

class user extends baseController
{
    public function getInfo($arr)
    {
        echo "user info";
       // var_dump($arr);
        $parm = json_encode(array("status"=>'ok'));
        $callback = "getUserInfo($parm);";
        $time_interval = 2;
       /* Timer::add($time_interval, function()
        {
            Gateway::sendToCurrentClient(json_encode(array("msg"=>"info",'status'=>'1','js'=>"getUserInfo('haha');")));
            echo "task run\n";
        });*/

        sleep(5);
        Gateway::sendToCurrentClient(json_encode(array("msg"=>"info",'status'=>'1','js'=>$callback)));
        //Timer::add(2, array($this, 'send'), array($callback), true);
        //Gateway::sendToCurrentClient(json_encode(array("msg"=>"info",'status'=>'1','js'=>$callback)));
        //die();
    }

    public function logout()
    {

    }

    public  function send($callback)
    {
        Gateway::sendToCurrentClient(json_encode(array("msg"=>"info",'status'=>'1','js'=>$callback)));
        echo "task run\n";
    }

}

