<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/29
 * Time: 15:29
 */

namespace Controller;
use \Core;
use \GatewayWorker\Lib\Gateway;
use \Model;

class baseController
{
    protected  $client_id;
    protected  $loginKey;
    public $auth = true;

    public function __construct($client_id,$loginKey,$func='')
    {
        $this->client_id = $client_id;
        $this->loginKey = $loginKey;
        $this->func = $func;
        echo "check login  $loginKey \r\n";
        var_dump($this->checkLogin());
        if(!$this->checkLogin())
        {
            Gateway::sendToCurrentClient(json_encode(array("msg"=>"please login",'status'=>'0','js'=>$this->func)));
            $this->auth = false;
            echo "尚未认证 \r\n";
            die();
        }

        //var_dump($this->checkLogin());
    }

    protected function _init($client_id,$loginKey)
    {
        // 检测登录信息
        /*$this->client_id = $client_id;
        $this->loginKey = $loginKey;*/
        /*if(empty($this->checkLogin()))
        {
            echo "$client_id 尚未验证，请先验证身份 \r\n";
            Gateway::sendToCurrentClient(json_encode(array("msg"=>"please login")));
        }*/

    }

    protected function checkLogin()
    {
        $userModel = new Model\user();
        return $userModel->checkLogin($this->loginKey);

    }

}