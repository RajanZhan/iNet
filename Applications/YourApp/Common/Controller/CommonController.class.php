<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/24
 * Time: 8:50
 */

namespace Common\Controller;

class CommonController
{
    protected $client_id;
    public function __construct($client_id)
    {
        $this->client_id = $client_id;
        echo "Common controller \r\n" ;
    }

}