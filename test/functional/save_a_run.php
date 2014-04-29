<?php
require_once('../../vendor/autoload.php');

xhprof_enable(XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY);

$a = array();
for($i=0; $i < 10000; $i++) {
	$a[] = rand(1,1000000);
}

$raw     = xhprof_disable();
$parser  = new \XhprofIo\Run\Parser();
$storage = new \XhprofIo\Storage\Pdo('mysql:host=localhost;dbname=xhprof', 'root', 'foobar');
$storage->save($parser->parse($raw));