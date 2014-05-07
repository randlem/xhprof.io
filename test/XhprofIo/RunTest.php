<?php
namespace XhprofIo;


class RunTest extends \PHPUnit_Framework_TestCase {

	protected $_target;

	public function setUp() {
		$this->_target = new Run();
	}

	protected function assertObject($vals, $target) {
		foreach ($vals as $name=>$val) {
			$this->assertAttributeEquals($val, '_'. $name, $target);
		}
	}

	public function testHydrateAssoc() {

	}

	public function testHydrateNumeric() {

	}

	public function testDehydrate() {

	}

	public function testGetterSetterRunId() {
		$target = $this->_target;
		$value  = 'runId';
		$this->assertAttributeEquals(NULL, '_id', $target);
		$this->assertSame($target, $target->setRunId($value));
		$this->assertAttributeEquals($value, '_id', $target);
		$this->assertEquals($value, $target->getRunId());
	}

	public function testGetterSetterRequestUri() {
		$target = $this->_target;
		$value  = 'requestUri';
		$this->assertAttributeEquals(NULL, '_uri', $target);
		$this->assertSame($target, $target->setRequestUri($value));
		$this->assertAttributeEquals($value, '_uri', $target);
		$this->assertEquals($value, $target->getRequestUri());
	}

	public function testGetterSetterRequestMethod() {
		$target = $this->_target;
		$valid  = array('GET', 'POST', 'PUT', 'DELETE', 'OPTIONS', 'HEAD', 'cli');

		$this->assertAttributeEquals(NULL, '_method', $target);
		$target->setRequestMethod('notvalid');
		$this->assertAttributeEquals(NULL, '_method', $target);

		foreach ($valid as $value) {
			$target->setRequestMethod($value);
			$this->assertAttributeEquals($value, '_method', $target);
			$this->assertEquals($value, $target->getRequestMethod());
		}
	}

	public function testGetterSetterServerName() {
		$target = $this->_target;
		$value  = 'serverName';
		$this->assertAttributeEquals(NULL, '_server', $target);
		$this->assertSame($target, $target->setServerName($value));
		$this->assertAttributeEquals($value, '_server', $target);
		$this->assertEquals($value, $target->getServerName());
	}

	public function testGetterSetterRequestTime() {
		$target = $this->_target;
		$value  = 'requestTime';
		$this->assertAttributeEquals(NULL, '_time', $target);
		$this->assertSame($target, $target->setRequestTime($value));
		$this->assertAttributeEquals($value, '_time', $target);
		$this->assertEquals($value, $target->getRequestTime());
	}

	public function testGetterSetterCallgraph() {

	}

}
 