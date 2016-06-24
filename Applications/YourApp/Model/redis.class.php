<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/27
 * Time: 17:53
 */

namespace Model;

class redis
{
    private static $_instance;
    public $redis;
    private function __construct()
    {
        $redis = new \Redis();
        $redis->connect(conf("redis-host"), conf("redis-port"));
        if(conf("redis_pwd"))
        {
            if ($redis->auth(conf("redis_pwd")) == false) {
                //die($redis->getLastError());
                echo "redis author field";
                return false;
            }
        }

        $this->redis = $redis;
    }

    public function __clone(){
        trigger_error('Clone is not allow!',E_USER_ERROR);
    }

    public static function getInstance(){
        if(!(self::$_instance instanceof self)){
            self::$_instance = new self;
        }
        return self::$_instance->redis;
    }
}