<?php
namespace XhprofIo\Run;


class Parser {

	/**
	 * @param array $raw
	 *
	 * @return \XhprofIo\Run
	 */
	public function parse($raw) {
		$run = new \XhprofIo\Run();

		$run->setRunId($this->generateUniqueRunId());
		if (php_sapi_name() == 'cli') {
			$this->buildCliRunMeta($run);
		} else {
			$this->buildApacheRunMeta($run);
		}

		$run->setCallgraph($this->parseCallgraph($raw));

		return $run;
	}

	/**
	 * @param \XhprofIo\Run $run
	 */
	protected function buildCliRunMeta(\XhprofIo\Run &$run) {
		$run->setRequestUri($_SERVER['PWD']. DIRECTORY_SEPARATOR. $_SERVER['SCRIPT_FILENAME']);
		$run->setRequestMethod('cli');
		$run->setServerName(php_uname('n'));
		$run->setRequestTime($_SERVER['REQUEST_TIME']);
	}

	/**
	 * @param \XhprofIo\Run $run
	 */
	protected function buildApacheRunMeta(\XhprofIo\Run &$run) {
		$run->setRequestUri($_SERVER['REQUEST_URI']);
		$run->setRequestMethod($_SERVER['REQUEST_METHOD']);
		$run->setServerName($_SERVER['SERVER_NAME']);
		$run->setRequestTime($_SERVER['REQUEST_TIME']);
	}

	/**
	 * @param array $raw
	 * @return Callgraph\Container
	 */
	protected function parseCallgraph($raw) {
		$callgraph = new Callgraph\Container();
		foreach ($raw as $call=>$data) {
			$parts = explode('==>', $call);
			if (count($parts) == 1) {
				$callee = $parts[0];
			} else {
				list($caller, $callee) = $parts;
			}

			$node = new Call();
			$node->setCaller(empty($caller) ? NULL : $caller)
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
		return sha1(php_uname('n'). getmypid(). microtime(TRUE));
	}

} 