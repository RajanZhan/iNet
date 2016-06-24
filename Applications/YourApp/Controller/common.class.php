<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/29
 * Time: 20:15
 */

namespace Controller;

use \Model;


class common
{

    protected $client_id;
    protected $loginKey;
    public $auth = true;

    public function __construct($client_id, $loginKey, $func = '')
    {
        $this->client_id = $client_id;
        $this->loginKey = $loginKey;
        $this->func = $func;
        /*echo "check login \r\n";
        if(!$this->checkLogin())
        {
            Gateway::sendToCurrentClient(json_encode(array("msg"=>"please login",'status'=>'0','js'=>$this->func)));
            $this->auth = false;
            echo "ипн╢хож╓ \r\n";
            die();
        }*/

        //var_dump($this->checkLogin());
    }

    public function  login($arr)
    {
        $userModel = new Model\user();
        $user_name = $arr["name"];
        $pwd = $arr["pwd"];
        $login_key = $userModel->login($user_name, $pwd, $this->client_id);

        if (!$login_key) {
            sendToCurrent(array('js' => "console.log('login field')"));
            echo 'error login \r\n';
        } else {
            sendToCurrent(array('msg' => $login_key, 'js' => "saveLoginInfo('$login_key')"));
            echo 'ok login \r\n';
        }

    }

    public function logout()
    {
        $userModel = new Model\user();
        /* $user_name = $arr["name"];
         $pwd = $arr["pwd"];*/
        $userModel->logout($this->loginKey);
        echo "logout ok \r\n";
        sendToCurrent(array('js' => "clearLogin()"));
        /*if(!$login_key)
        {
            sendToCurrent(array('js'=>"console.log('login field')"));
            echo 'error login \r\n';
        }
        else
        {
            sendToCurrent(array('msg'=>$login_key,'js'=>"console.log('login ok')"));
            echo 'ok login \r\n';
        }*/
    }

    /* public function sendCurent($msg)
     {
         Gateway::sendToCurrentClient($msg);
     }*/
}