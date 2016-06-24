<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/27
 * Time: 18:04
 */

namespace Core;
use \GatewayWorker\Lib\Gateway;
class rajan
{
    public function __construct()
    {
        if(method_exists($this,"_init"))
        {
            $this->_init();
        }
        //$this->_init();
    }

    // 发送数据给客户端
    public function sendCurent($msg)
    {
        Gateway::sendCurent(json_encode($msg));
    }

}