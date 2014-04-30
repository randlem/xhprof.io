<?php
namespace XhprofIo\Middleware;


class Rest extends \Slim\Middleware {

	public function call() {
		$this->next->call();
	}

} 