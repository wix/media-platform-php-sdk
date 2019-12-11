<?php
/**
 * Created by PhpStorm.
 * User: leong
 * Date: 2019-02-05
 * Time: 15:53
 */

namespace Wix\Mediaplatform\Model\Request;


/**
 * Class Callback
 * @package Wix\Mediaplatform\Model\Request
 */
class Callback extends BaseRequest {
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
	 * JobCallback constructor.
	 *
	 * @param string $url
	 * @param array $attachment
	 * @param array $headers
	 */
	public function __construct( $url = null, array $attachment = array(), array $headers = array()) {
		$this->url         = $url;
		$this->attachment  = $attachment;
		$this->headers     = $headers;
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
	 * @return Callback
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
	 * @return Callback
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
	 * @return Callback
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
	 * @return Callback
	 */
	public function setPassthrough( $passthrough ) {
		$this->passthrough = $passthrough;

		return $this;
	}


}