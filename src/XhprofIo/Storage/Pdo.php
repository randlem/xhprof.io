<?php
namespace XhprofIo\Storage;

class Pdo implements Engine {

	/**
	 * @var PDO
	 */
	protected $_conn;

	/**
	 * @param string|PDO $dsn
	 * @param string $user
	 * @param string $pass
	 *
	 * @throws \RuntimeException
	 * @throws \PDOException
	 */
	public function __construct($dsn, $user='', $pass='') {
		if ($dsn instanceof \PDO) {
			$this->_conn = $dsn;
		} else {
			if (empty($dsn)) {
				throw new \RuntimeException('PDO connections require a DSN');
			}
			$this->_conn = new \PDO($dsn, $user, $pass);
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
	 * @return \XhprofIo\Run
	 */
	public function load($id) {
		$run  = $this->loadRun($id);
		$run->setCallgraph($this->loadCallgraph($id));
		return $run;
	}

	/**
	 * @param $id
	 *
	 * @return \XhprofIo\Run
	 * @throws \RuntimeException
	 */
	protected function loadRun($id) {
		$stmt = $this->_conn->prepare('SELECT * FROM `runs` WHERE id = ?');
		$stmt->bindParam(1, $id);
		$stmt->execute();
		if (!($raw = $stmt->fetch(PDO::FETCH_ASSOC))) {
			throw new \RuntimeException('Couldn\'t find run with id = '. $id);
		}

		$run = new \XhprofIo\Run();
		$run->hydrate($raw);
		return $run;
	}

	/**
	 * @param $id
	 *
	 * @return \XhprofIo\Run\Callgraph\Container
	 */
	protected function loadCallgraph($id) {
		$stmt = $this->_conn->prepare('SELECT * FROM `callgraphs` WHERE runId = ?');
		$stmt->bindParam(1, $id);
		$stmt->execute();

		$callgraph = new \XhprofIo\Run\Callgraph\Container();
		while ($raw = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$node = new \XhprofIo\Run\Call();
			$node->hydrate($raw);
			$callgraph->append($node);
		}

		return $callgraph;
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