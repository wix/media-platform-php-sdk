<?php


namespace Wix\Mediaplatform\Model\Request;

class UploadConfigurationRequest extends BaseRequest
{
	/**
	 * @var 'private' | 'public'
	 */
	protected $acl;

	/**
     * @var string
     */
    protected $mimeType;

	/**
	 * @var string
	 */
    protected $path;


	/**
	 * @var number
	 */
    protected $size;

	/**
	 * @var Callback
	 */
    protected $callback;

	/**
	 * UploadConfigurationRequest constructor.
	 *
	 * @param $acl
	 * @param $mimeType
	 * @param $path
	 * @param $size
	 * @param $callback
	 */
    public function __construct($acl = null, $mimeType = null, $path = null, $size = null, $callback = null) {
    	$this->acl  = $acl;
    	$this->mimeType = $mimeType;
    	$this->path = $path;
    	$this->size = $size;
    	$this->callback = $callback;
    }

	/**
	 * @return mixed
	 */
	public function getAcl() {
		return $this->acl;
	}

	/**
	 * @param mixed $acl
	 *
	 * @return UploadConfigurationRequest
	 */
	public function setAcl( $acl ) {
		$this->acl = $acl;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getMimeType() {
		return $this->mimeType;
	}

	/**
	 * @param string $mimeType
	 *
	 * @return UploadConfigurationRequest
	 */
	public function setMimeType( $mimeType ) {
		$this->mimeType = $mimeType;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPath() {
		return $this->path;
	}

	/**
	 * @param string $path
	 *
	 * @return UploadConfigurationRequest
	 */
	public function setPath( $path ) {
		$this->path = $path;

		return $this;
	}

	/**
	 * @return number
	 */
	public function getSize() {
		return $this->size;
	}

	/**
	 * @param number $size
	 *
	 * @return UploadConfigurationRequest
	 */
	public function setSize( $size ) {
		$this->size = $size;

		return $this;
	}

	/**
	 * @return callable
	 */
	public function getCallback() {
		return $this->callback;
	}

	/**
	 * @param callable $callback
	 *
	 * @return UploadConfigurationRequest
	 */
	public function setCallback( $callback ) {
		$this->callback = $callback;

		return $this;
	}

}