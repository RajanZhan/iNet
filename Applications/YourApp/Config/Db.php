<?php
namespace Config;
/**
 * mysql����
 * @author walkor
 */
class Db
{
    /**
     * ���ݿ��һ��ʵ�����ã���ʹ��ʱ����������ʹ��
     * $user_array = Db::instance('db1')->select('name,age')->from('users')->where('age>12')->query();
     * �ȼ���
     * $user_array = Db::instance('db1')->query('SELECT `name`,`age` FROM `users` WHERE `age`>12');
     * @var array
     */
    public static $mianDb = array(
        'host'    => '10.66.162.24',
        'port'    => 3306,
        'user'    => 'root',
        'password' => 'f78y$9adh(*@jud',
        'dbname'  => 'ichat',
        'charset'    => 'utf8',
    );

    public static $native = array(
        'host'    => '127.0.0.1',
        'port'    => 3306,
        'user'    => 'root',
        'password' => 'yMr5GAXLmlYB',
        'dbname'  => 'ichat',
        'charset'    => 'utf8',
    );

}