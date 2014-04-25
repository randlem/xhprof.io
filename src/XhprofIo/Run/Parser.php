<?php
namespace XhprofIo\Run;


class Parser {

	/**
	 * @param array $raw
	 * @return \XhprofIo\Run
	 */
	public function parse($raw) {
		$run = new \XhprofIo\Run();

		$run->setRunId($this->generateUniqueRunId());
		$run->setRequestUri($_SERVER['REQUEST_URI']);
		$run->setRequestMethod($_SERVER['REQUEST_METHOD']);
		$run->setServerName($_SERVER['SERVER_NAME']);
		$run->setRequestTime($_SERVER['REQUEST_TIME']);
		$run->setCallgraph($this->parseCallgraph($raw));

		return $run;
	}

	/**
	 * @param array $raw
	 * @return Callgraph\Container
	 */
	protected function parseCallgraph($raw) {
		$callgraph = new Callgraph\Container();
		foreach ($raw_data as $call=>$data) {
			list($caller, $callee) = explode('==>', $call);

			$node = new \XhprofIo\Run\Call();
			$node->setCaller(empty($caller) ? NULL : $caller);
				 ->setCallee($callee)
				 ->setCount($data['ct'])
				 ->setCpuTime($data['cpu'])
				 ->setWallTime($data['wt'])
				 ->setMemory($data['mu'])
				 ->setPeakMemory($data['pmu']);
			$callgraph->append($node);
		}
		return $callgraph;
	}

	/**
	 * @return string
	 */
	protected function generateUniqueRunId() {
		return sha1($_SERVER['SERVER_NAME']. $_SERVER['REQUEST_URI']. $_SERVER['REQUEST_METHOD']. microtime(TRUE));
	}

} 