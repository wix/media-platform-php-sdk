<?php
/**
 * Created by PhpStorm.
 * User: leong
 * Date: 2019-02-05
 * Time: 15:53
 */

namespace Wix\Mediaplatform\Model\Request;


/**
 * Class JobCallback
 * @package Wix\Mediaplatform\Model\Request
 */
class JobCallback extends Callback {
	/**
	 * @var $passthrough boolean
	 */
	protected $passthrough;

	/**
	 * JobCallback constructor.
	 *
	 * @param string $url
	 * @param array $attachment
	 * @param array $headers
	 * @param bool $passthrough
	 */
	public function __construct( $url = null, array $attachment = array(), array $headers = array(), $passthrough = false) {
		parent::__construct($url, $attachment, $headers);
		$this->passthrough = $passthrough;
	}

	/**
	 * @return boolean
	 */
	public function getPassthrough() {
		return $this->passthrough;
	}

	/**
	 * @param boolean $passthrough
	 *
	 * @return JobCallback
	 */
	public function setPassthrough( $passthrough ) {
		$this->passthrough = $passthrough;

		return $this;
	}


}