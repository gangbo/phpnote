<?php
namespace MyProject;
include 'B.php';
use Util as CC;
#use Util\B;

/*
spl_autoload_register(array(
    'MyProject\A',
    'myautoload'
));
*/
class A {
    public static function myautoload($classname) {
        echo 'classname=' . $classname;
        include $classname.'.php';
    }
    public function __construct() {
        echo "new A \n";
    }

    public function testAutoLoad(){
        return new B();
    }
    public function __destruct(){
        echo "descruct A \n";
    }
}
$a = new A();
#$b = $a->testAutoLoad();
CC\aaa();
\Util\aaa();
new B();
