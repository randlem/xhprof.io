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
	 *
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
	 *
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
	 *
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
	 *
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
	 *
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

	/**
	 * @param array $vals
	 */
	public function hydrate(array $vals) {
		$this->_id     = (isset($vals['id']))     ? $vals['id']     : $vals[0];
		$this->_uri    = (isset($vals['uri']))    ? $vals['uri']    : $vals[1];
		$this->_method = (isset($vals['method'])) ? $vals['method'] : $vals[2];
		$this->_server = (isset($vals['server'])) ? $vals['server'] : $vals[3];
		$this->_time   = (isset($vals['time']))   ? $vals['time']   : $vals[4];
	}

	/**
	 * @return array
	 */
	public function dehydrate() {
		return array(
			'id'     => $this->_id,
			'uri'    => $this->_uri,
			'method' => $this->_method,
			'server' => $this->_server,
			'time'   => $this->_time,
		);
	}

} 