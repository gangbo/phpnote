<?php
// phar-builder.php
$phar = new Phar('phar-demo.phar');
$phar->buildFromDirectory(dirname(__FILE__).'/', '/\.php$/');
$phar->compressFiles( Phar::GZ );
$phar->stopBuffering();
$phar->setStub( $phar->createDefaultStub('index.php') );
