<?php
require_once('../vendor/autoload.php');

$storage = new \XhprofIo\Storage\Pdo('mysql:host=localhost;dbname=xhprof', 'root', 'foobar');
$app     = new \Slim\Slim();
$app->config('templates.path', '../templates');

$app->get('/runs', function () use ($app, $storage) {
	$avail = $storage->available();
	foreach ($avail as $i=>$r) {
		$avail[$i] = $r->dehydrate();
	}
	echo json_encode($avail);
});

$app->get('/runs/:runId', function ($id) use ($app, $storage) {

});

$app->run();