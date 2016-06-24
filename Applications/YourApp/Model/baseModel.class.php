<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/27
 * Time: 18:01
 */

namespace Model;
use Core;
use \GatewayWorker\Lib;
class baseModel extends Core\rajan
{
    public $redis ;
    public $db;
    protected function _init()
    {
        //echo "base model init";
        $this->redis = redis::getInstance();
        $this->db = Lib\Db::instance("native");
    }
}