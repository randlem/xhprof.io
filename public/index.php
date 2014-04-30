<?php
require_once('../vendor/autoload.php');

$storage = new \XhprofIo\Storage\Pdo();
$app     = new \Slim\Slim();
$app->config('templates.path', '../templates');

$app->get('/runs', function () use ($app, $storage) {
	echo json_encode($storage->available());
});

$app->get('/runs/:runId', function ($id) use ($app, $storage) {

});

$app->run();