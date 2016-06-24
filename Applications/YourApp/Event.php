<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;

//use \Model;
/*use \Controller;*/
use \Common;
//use \Home\Controller;

// 加载 命名空间
//$module_list = explode(',',C('module_list'));
//var_dump(conf('redis-host'));
//var_dump(C('module_list'));

/*require_once("Model/user.php");*/

/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Event
{

    /**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     *
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {
        echo "some one is connect ";
        // 向当前client_id发送数据
        //Gateway::sendToClient($client_id, "Hello $client_id");
        // 向所有人发送
        //Gateway::sendToAll("$client_id login");
    }

    /**
     * 当客户端发来消息时触发
     * @param int $client_id 连接id
     * @param mixed $message 具体消息
     */
    public static function onMessage($client_id, $message)
    {


        //C("name",'aasss');
        /**/
        $msg = (array)json_decode($message);
        $parm = self::parmMsg1($msg);
        //self::checkMsg($parm['s']); // 验证数据合法性
        // 分析参数,
        /*var_dump($parm);
        return;*/

        // var_dump($parm);
        $module = $parm['m'];
        $controller = $parm['c'];
        $method = $parm['a'];
        $p = $parm['p'];
        $func = $parm['f'];  /*/**/// 客户端回调函数

        /*$index = new Home\Controller\Index();//Index();
        //sendToCurrent('hahaha');

        $index->index();
        return;*/
        //echo conf("redis-host").'-----';

        //echo "client id is $client_id";

        if ($module && $controller && $method) {
            $loginKey = $parm["login_key"];
            $str = '$c = ' . "new $module\\Controller\\$controller('$client_id');" . '$c ->' . "$method(\$p);";
            eval($str);
            //echo $str;
        } else {
            // Gateway::sendToCurrentClient('fatal error,the path is wrong');
            sendToCurrent('fatal error,the path is wrong');
        }
        /* $user = new Model\user();
         //$user->setSql();
         $loginKey = $msg["login_key"];

         if(!$user->checkLogin($loginKey))
         {
             if($msg['type'] != "login" )
             {
                 echo "$client_id 尚未验证，请先验证身份 \r\n";
                 Gateway::sendToCurrentClient(json_encode(array("msg"=>"please login")));
                 return;
             }
             $userName = $msg['userName'];
             $pwd = $msg['pwd'];
             $loginKey = $user->login($userName,$pwd,$client_id);

             if(!$loginKey)
             {
                 Gateway::sendToCurrentClient(json_encode(array("msg"=>"vervify error")));
                 return;
             }

             //$loginKey = md5($client_id.$userName);
             //$_SESSION[$loginKey]["name"] = $userName;
             Gateway::sendToCurrentClient(json_encode(array("login_key"=>$loginKey)));
             echo "保存登录信息成功 \r\n";
         }

         if($msg["type"] == "logout")
         {
             $user->logout($loginKey);
             Gateway::sendToCurrentClient(json_encode(array("msg"=>"logout ok",'js'=>"clearLogin();")));
         }

         //Gateway::sendToAll(json_encode(array("msg"=>"data ok")));
         echo '合法数据：'.$message . "\n\r";
         Gateway::sendToUid("rajan",json_encode(array("msg"=>"msg from Uid")));*/
    }

    /**
     * 当用户断开连接时触发
     * @param int $client_id 连接id
     */
    public static function onClose($client_id)
    {
        // 向所有人发送
        //GateWay::sendToAll("$client_id logout");
        echo "$client_id 已经关闭连接";
    }

    // 验证信息的合法性
    public static function checkMsg($safe_key)
    {
        //echo 'check';return;
        if ($safe_key != "112") {
            echo '非法连接';
            Gateway::sendToCurrentClient("非法连接");
            Gateway::closeCurrentClient();
        }
    }

    // 分析传过来的参数
    public static function parmMsg($data)
    {
        $res = array();
        $method = $data['method'] ? $data['method'] : '/';
        $parm = $data['parm'];
        $safe_key = $data['safe_code'];
        $func = $data['func'];
        if (is_object($parm)) {
            $parm = (array)$parm;
        }
        $method_arr = explode("/", $method);
        $res["c"] = $method_arr[0] ? $method_arr[0] : conf('default_module');
        $res["m"] = $method_arr[1];
        $res["p"] = $parm;
        $res["s"] = $safe_key;
        $res["func"] = $func;
        $res["login_key"] = $data['login_key'];;
        return $res;
    }

    public static function parmMsg1($data)
    {
        $res = array();
        $method = $data['m'] ? $data['m'] : '/';
        $parm = $data['p'] ? $data['p'] : '';
        $safe_key = $data['s'] ? $data['s'] : '';
        $func = $data['f'] ? $data['f'] : '';
        if (is_object($parm)) {
            $parm = (array)$parm;
        }
        $method_arr = explode("/", $method);
        $res["m"] = $method_arr[0] ? $method_arr[0] : conf('default_module');
        $res["c"] = $method_arr[1] ? $method_arr[1] : conf('default_controller');
        $res["a"] = $method_arr[2] ? $method_arr[2] : conf('default_action');
        $res["p"] = $parm;
        $res["s"] = $safe_key;
        $res["f"] = $func;
        //$res["login_key"] = $data['login_key'];;
        return $res;
    }

    //

}
