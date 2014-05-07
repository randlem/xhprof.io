<?php
namespace XhprofIo\Run;

class CallTest extends \PHPUnit_Framework_TestCase {

	protected $_target;

	public function setUp() {
		$this->_target = new Call();
	}

	protected function assertObject($vals, $target) {
		foreach ($vals as $name=>$val) {
			$this->assertAttributeEquals($val, '_'. $name, $target);
		}
	}

	public function testHydrateAssoc() {
		$target = $this->_target;

		$this->assertObject(array(
			'caller'   => NULL,
			'callee'   => NULL,
			'internal' => NULL,
			'ct'       => NULL,
			'wt'       => NULL,
			'cpu'      => NULL,
			'mu'       => NULL,
			'pmu'      => NULL,
		), $target);

		$assoc = array(
			'caller'   => 'caller',
			'callee'   => 'callee',
			'internal' => 'internal',
			'ct'       => 'ct',
			'wt'       => 'wt',
			'cpu'      => 'cpu',
			'mu'       => 'mu',
			'pmu'      => 'pmu',
		);
		$target->hydrate($assoc);
		$this->assertObject($assoc, $target);
	}

	public function testHydrateIndexed() {
		$target = $this->_target;

		$this->assertObject(array(
			'caller'   => NULL,
			'callee'   => NULL,
			'internal' => NULL,
			'ct'       => NULL,
			'wt'       => NULL,
			'cpu'      => NULL,
			'mu'       => NULL,
			'pmu'      => NULL,
		), $target);

		$assoc = array(
			'caller'   => 'caller',
			'callee'   => 'callee',
			'internal' => 'internal',
			'ct'       => 'ct',
			'cpu'      => 'cpu',
			'wt'       => 'wt',
			'mu'       => 'mu',
			'pmu'      => 'pmu',
		);
		$target->hydrate(array_values($assoc));
		$this->assertObject($assoc, $target);
	}

	public function testDehydrate() {
		$target = $this->_target;

		$setInternal = function($prop, $val) use (&$target) {
			static $reflection;
			if (empty($reflection)) {
				$reflection = new \ReflectionClass($target);
			}

			$property = $reflection->getProperty('_'. $prop);
			$property->setAccessible(TRUE);
			$property->setValue($target, $val);
		};

		$vals = array(
			'caller'   => 'caller',
			'callee'   => 'callee',
			'internal' => 'internal',
			'ct'       => 'ct',
			'cpu'      => 'cpu',
			'wt'       => 'wt',
			'mu'       => 'mu',
			'pmu'      => 'pmu',
		);

		foreach ($vals as $prop=>$val) {
			$setInternal($prop, $val);
		}

		$this->assertEquals($vals, $target->dehydrate());
	}

	public function testSetCaller() {
		$target = $this->_target;

		$this->assertAttributeEquals(NULL, '_caller', $target);
		$this->assertSame($target, $target->setCaller('caller'));
		$this->assertAttributeEquals('caller', '_caller', $target);
	}

	public function testSetCallee() {
		$target = $this->_target;

		$this->assertAttributeEquals(NULL, '_callee', $target);
		$this->assertSame($target, $target->setCallee('callee'));
		$this->assertAttributeEquals('callee', '_callee', $target);
		$this->assertAttributeEquals(FALSE, '_internal', $target);

		$this->assertSame($target, $target->setCallee('is_string'));
		$this->assertAttributeEquals('is_string', '_callee', $target);
		$this->assertAttributeEquals(TRUE, '_internal', $target);
	}

	public function testSetCount() {
		$target = $this->_target;

		$this->assertAttributeEquals(NULL, '_ct', $target);
		$this->assertSame($target, $target->setCount(1234));
		$this->assertAttributeEquals(1234, '_ct', $target);
	}

	public function testSetWallTime() {
		$target = $this->_target;

		$this->assertAttributeEquals(NULL, '_wt', $target);
		$this->assertSame($target, $target->setWallTime(1234));
		$this->assertAttributeEquals(1234, '_wt', $target);
	}

	public function testSetCpuTime() {
		$target = $this->_target;

		$this->assertAttributeEquals(NULL, '_cpu', $target);
		$this->assertSame($target, $target->setCpuTime(1234));
		$this->assertAttributeEquals(1234, '_cpu', $target);
	}

	public function testSetMemory() {
		$target = $this->_target;

		$this->assertAttributeEquals(NULL, '_mu', $target);
		$this->assertSame($target, $target->setMemory(1234));
		$this->assertAttributeEquals(1234, '_mu', $target);
	}

	public function testSetPeakMemory() {
		$target = $this->_target;

		$this->assertAttributeEquals(NULL, '_pmu', $target);
		$this->assertSame($target, $target->setPeakMemory(1234));
		$this->assertAttributeEquals(1234, '_pmu', $target);
	}

}
 