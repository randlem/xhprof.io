<?php
namespace XhprofIo\Run;

use \XhprofIo\Utility\Hydrateable;
use \XhprofIo\Utility\Dehydrateable;

class Call implements Hydrateable, Dehydrateable  {

	/**
	 * @var string|null
	 */
	protected $_caller;

	/**
	 * @var string
	 */
	protected $_callee;

	/**
	 * @var int
	 */
	protected $_ct;

	/**
	 * @var int
	 */
	protected $_wt;

	/**
	 * @var int
	 */
	protected $_cpu;

	/**
	 * @var int
	 */
	protected $_mu;

	/**
	 * @var int
	 */
	protected $_pmu;

	/**
	 * @param string $caller
	 * @return $this
	 */
	public function setCaller($caller) {
		$this->_caller = $caller;
		return $this;
	}

	/**
	 * @param string $callee
	 * @return $this
	 */
	public function setCallee($callee) {
		$this->_callee = $callee;
		return $this;
	}

	/**
	 * @param int $ct
	 * @return $this
	 */
	public function setCount($ct) {
		$this->_ct = $ct;
		return $this;
	}

	/**
	 * @param int $wt
	 * @return $this
	 */
	public function setWallTime($wt) {
		$this->_wt = $wt;
		return $this;
	}

	/**
	 * @param int $cpu
	 * @return $this
	 */
	public function setCpuTime($cpu) {
		$this->_cpu = $cpu;
		return $this;
	}

	/**
	 * @param int $mu
	 * @return $this
	 */
	public function setMemory($mu) {
		$this->_mu = $mu;
		return $this;
	}

	/**
	 * @param int $pmu
	 * @return $this
	 */
	public function setPeakMemory($pmu) {
		$this->_pmu = $pmu;
	}

	public function hydrate($vals) {

	}

	public function dehydrate() {
		return array(
			$this->_caller,
			$this->_callee,
			$this->_ct,
			$this->_cpu,
			$this->_wt,
			$this->_mu,
			$this->_pmu,
		);
	}

} 