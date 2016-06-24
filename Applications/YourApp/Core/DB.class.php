<?php
/**
 * Created by PhpStorm.
 * User: Rajan
 * Date: 2016/3/29
 * Time: 13:40
 */

namespace Core;
use \GatewayWorker\Lib;

class DB
{
    /* public static function instance($config_name)
     {
         if(!isset(\Config\Db::$$config_name))
         {
             echo "\\Config\\Db::$config_name not set\n";
             throw new \Exception("\\Config\\Db::$config_name not set\n");
         }

         if(empty(self::$instance[$config_name]))
         {
             $config = \Config\Db::$$config_name;
             self::$instance[$config_name] = new \GatewayWorker\Lib\DbConnection($config['host'], $config['port'], $config['user'], $config['password'], $config['dbname']);
         }
         return self::$instance[$config_name];
     }*/

    protected static $db;

    public static function getInstance()
    {
        if (empty(self::$db)) {
            self::$db = new Lib\DbConnection('10.66.162.24', '3306', 'root', 'f78y$9adh(*@jud', 'ichat');
        }
        return self::$db;
    }

    public static function close()
    {
        {
            if (isset(self::$db)) {
                self::$db->closeConnection();
                self::$db = null;
            }
        }
    }



}
