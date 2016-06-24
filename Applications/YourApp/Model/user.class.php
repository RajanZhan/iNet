<?php
/**
 * Created by PhpStorm.
 * User: Rajan
 * Date: 2016/3/27
 * Time: 15:56
 */

namespace Model;
use \Core;
use \GatewayWorker\Lib\Gateway;
class user extends baseModel
{
    public $redis ;
    public  function _init()
    {
        //echo 'user init ';
        parent::_init();
        /*$this->redis = new Redis();
        $this->redis->connect('127.0.0.1', 6379);*/
    }

    public function test(){
        echo 'user test';
    }

    public function login($user,$pwd,$client_id)
    {
        if($user!="rajan" || $pwd!="111111")
        {
            return false;
        }

        // 将用户的连接信息写入缓存
        Gateway::bindUid($client_id,'rajan');
        $loginKey = md5($client_id.$user);
        $this->redis->setex($loginKey,3600,$user);
        //$this->redis->set("name",'rajan');
        //C("name","rajan");
        //$this->redis->set("name",'rajan');
        return  $loginKey;
    }

    public function checkLogin($loginKey)
    {
        return $this->redis->get($loginKey);
    }

    public function logout($loginKey)
    {
        $this->redis->del($loginKey);
    }

    /**
     *
     */
    public  function  setSql()
    {

        //$insert_id = $db->insert("user")->cols(array("name"=>'rajan'))->query();
        $res = $this->db->select("*")->from("user")->row();
        //echo "res  is $res";
        //var_dump($res);
    }
}