<?php
// +----------------------------------------------------------------------
// | Created by PhpStorm
// +----------------------------------------------------------------------
// | Date: 2017/8/27 19:21
// +----------------------------------------------------------------------
// | Use : 说明用途，主要方面！
// +----------------------------------------------------------------------
// | Author: 联之通 <1850167575@qq.com>
// +----------------------------------------------------------------------

class My_db {
    //静态变量保存全局实例
    private static $_instance = null;
    //私有构造函数，防止外界实例化对象
    private function __construct() {
    }
    //私有克隆函数，防止外办克隆对象
    private function __clone() {
    }
    //静态方法，单例统一访问入口
    static public function getInstance() {
        if (is_null ( self::$_instance ) || isset ( self::$_instance )) {
            self::$_instance = new mysqli('localhost','root','123456','message_board');
            self::$_instance -> query('set names utf8');
        }
        return self::$_instance;
    }
    public function getName() {
        echo 'hello world!';
    }
}