<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/23
 * Time: 20:18
 */
namespace Common;
use \GatewayWorker\Lib\Gateway;

function sendToCurrentClinet($msg)
{
    Gateway::sendToCurrentClient($msg);
}