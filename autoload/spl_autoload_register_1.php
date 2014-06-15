<?php
/**
 php 自动加载,php中当使用一个class时，而这个class
 又没有被include进来时，则会出发 __autoload方法,
 我们也可以注册自己的autoload方法,可以使用
 spl_autoload_register方法注册
 */
spl_autoload_register('_myautoload');
function _myautoload($classname) {
    echo " autoload $classname \n";
    include $classname . '.php';
}
new B();
