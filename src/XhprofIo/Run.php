<?php
namespace XhprofIo;

use \XhprofIo\Utility\Hydrateable;
use \XhprofIo\Utility\Dehydrateable;

class Run implements Hydrateable, Dehydrateable {

	/**
	 * @var string
	 */
	protected $_id;

	/**
	 * @var string
	 */
	protected $_uri;

	/**
	 * @var string
	 */
	protected $_method;

	/**
	 * @var string
	 */
	protected $_server;

	/**
	 * @var int
	 */
	protected $_time;

	/**
	 * @var Run\Callgraph\Container
	 */
	protected $_callgraph;

	/**
	 * @param string $id
	 * @return $this
	 */
	public function setRunId($id) {
		$this->_id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getRunId() {
		return $this->_id;
	}

	/**
	 * @param string $uri
	 * @return $this
	 */
	public function setRequestUri($uri) {
		$this->_uri = $uri;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getRequestUri() {
		return $this->_uri;
	}

	/**
	 * @param string $method
	 * @return $this
	 */
	public function setRequestMethod($method) {
		switch ($method) {
			case 'GET':
			case 'POST':
			case 'PUT':
			case 'DELETE':
			case 'OPTIONS':
			case 'HEAD':
			case 'cli':  {
				$this->_method = $method;
			} break;
		}
		return $this;
	}

	/**
	 * @return string
	 */
	public function getRequestMethod() {
		return $this->_method;
	}

	/**
	 * @param string $server
	 * @return $this
	 */
	public function setServerName($server) {
		$this->_server = $server;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getServerName() {
		return $this->_server;
	}

	/**
	 * @param int $time
	 * @return $this
	 */
	public function setRequestTime($time) {
		$this->_time = $time;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getRequestTime() {
		return $this->_time;
	}

	/**
	 * @param Run\Callgraph\Container $callgraph
	 * @return $this
	 */
	public function setCallgraph(Run\Callgraph\Container $callgraph) {
		$this->_callgraph = $callgraph;
		return $this;
	}

	/**
	 * @return Run\Callgraph\Container
	 */
	public function getCallgraph() {
		return $this->_callgraph;
	}

	public function hydrate($vals) {

	}

	/**
	 * @return array
	 */
	public function dehydrate() {
		return array(
			$this->_id,
			$this->_uri,
			$this->_method,
			$this->_server,
			$this->_time,
		);
	}

} 