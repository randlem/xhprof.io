<?php
namespace XhprofIo\Storage;


interface Engine {

	/**
	 * @param \XhprofIo\Run $run
	 *
	 * @return bool
	 */
	public function save(\XhprofIo\Run $run);

	/**
	 * @param string $id\
	 *
	 * @return \XhprofIo\Run
	 */
	public function load($id);


}