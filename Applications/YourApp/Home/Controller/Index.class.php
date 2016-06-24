<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/23
 * Time: 20:22
 */

namespace Home\Controller;
use \Common;
use \Home\Model;
use \Common\Controller\CommonController;

class Index extends CommonController
{
    /*protected $client_id;
    public function __construct($client_id)
    {
        $this->client_id = $client_id;
    }*/

    public function index()
    {
        //return "Home index ";
        echo "home index";
        echo 'client_id'.$this->client_id;
        /*$user = new Model\User();
        $user->getName();*/
        //sendToCurrent("Home index ");
    }
    public function test()
    {
        echo 'test';
    }
}