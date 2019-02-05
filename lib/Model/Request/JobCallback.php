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
class JobCallback {
	/**
	 * @var $url string
	 */
	private $url;
	/**
	 * @var $attachment array()
	 */
	private $attachment;
	/**
	 * @var $headers array()
	 */
	private $headers;
	/**
	 * @var $passthrough boolean
	 */
	private $passthrough;

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