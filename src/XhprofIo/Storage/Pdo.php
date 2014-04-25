<?php
namespace XhprofIo\Storage;


class Pdo implements Engine {

	/**
	 * @var PDO
	 */
	protected $_conn;

	/**
	 * @param string|PDO $driver
	 * @param string $host
	 * @param string $database
	 * @param string $user
	 * @param string $pass
	 * @throws \RuntimeException
	 * @throws \PDOException
	 */
	public function __construct($driver, $host='', $database='', $user='', $pass='') {
		if ($driver instanceof PDO) {
			$this->_conn = $driver;
		} else {
			if (empty($driver) || empty($host) || empty($database)) {
				throw new \RuntimeException('PDO connections require a driver, host, and database name');
			}

			$availDrivers = PDO::getAvailableDrivers();
			if (!in_array($driver, $availDrivers)) {
				throw new \RuntimeException('PDO driver type not in list of available drivers: '. implode(', ', $availDrivers));
			}

			$dsn = implode(':', array($driver, 'dbname='. $database, 'host='. $host));
			$this->_conn = new PDO($dsn, $user, $pass);
		}
	}

	/**
	 * @param \XhprofIo\Run $run
	 *
	 * @return bool
	 * @throws \Exception
	 */
	public function save(\XhprofIo\Run $run) {
		$conn = $this->_conn;
		try {
			$conn->beginTransaction();
			$this->saveRun($run);
			$this->saveCallgraph($run);
			$conn->commit();
		} catch (\Exception $e) {
			$conn->rollBack();
			throw $e;
		}

		return TRUE;
	}

	/**
	 * @param string $id
	 *
	 * @return null|\XhprofIo\Run
	 */
	public function load($id) {

	}

	/**
	 * @param \XhprofIo\Run $run
	 */
	protected function saveRun(\XhprofIo\Run $run) {
		$conn   = $this->_conn;
		$query  = 'INSERT INTO `runs` (`id`, `uri`, `method`, `server`, `time`) VALUES (?, ?, ?, ?, ?)';
		$conn->prepare($query)->execute($run->dehydrate());
	}

	/**
	 * @param \XhprofIo\Run $run
	 */
	protected function saveCallgraph(\XhprofIo\Run $run) {
		$conn  = $this->_conn;
		$query = 'INSERT INTO `callgraphs` (`runId`, `caller`, `callee`, `ct`, `cpu`, `wt`, `mu`, `pmu`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
		$stmt  = $conn->prepare($query);

		foreach ($run->getCallgraph() as $call) {
			$a = $call->dehydrate();
			array_unshift($a, $run->getRunId());
			$stmt->execute($a);
		}
	}

} 