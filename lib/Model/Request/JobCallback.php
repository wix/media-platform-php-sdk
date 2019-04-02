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
 * @package Wix\Mediaplatform\Model\Job
 */
class JobCallback extends BaseRequest {
	/**
	 * @var $url string
	 */
	protected $url;
	/**
	 * @var $attachment array()
	 */
	protected $attachment;
	/**
	 * @var $headers array()
	 */
	protected $headers;
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
		$this->url         = $url;
		$this->attachment  = $attachment;
		$this->headers     = $headers;
		$this->passthrough = $passthrough;
	}


	/**
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * @param mixed $url
	 *
	 * @return JobCallback
	 */
	public function setUrl( $url ) {
		$this->url = $url;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getAttachment() {
		return $this->attachment;
	}

	/**
	 * @param array $attachment
	 *
	 * @return JobCallback
	 */
	public function setAttachment( $attachment ) {
		$this->attachment = $attachment;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getHeaders() {
		return $this->headers;
	}

	/**
	 * @param array $headers
	 *
	 * @return JobCallback
	 */
	public function setHeaders( $headers ) {
		$this->headers = $headers;

		return $this;
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