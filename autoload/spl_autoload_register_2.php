<?php
/**
 spl_autoload_register方法注册
 也可以注册类和静态方法
 两种写法都可以
 */
#spl_autoload_register(array('A','_myautoload'));
spl_autoload_register('A::_myautoload');
class A {
    public function __construct() {
        echo "new A \n";
    }
    public static function _myautoload($classname) {
        include $classname . '.php';
    }
    public function __destruct() {
        echo "descruct A \n";
    }
}
new B();
