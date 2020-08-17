<?php


namespace Wix\Mediaplatform\Model\Response;
use Wix\Mediaplatform\Model\BaseModel;

/**
 * Class GetUploadUrlResponse
 * @package Wix\Mediaplatform\Model\Response
 */
class GetUploadConfigurationResponse extends BaseModel {
	/**
	 * @var string
	 */
	protected $uploadUrl;


	/**
	 * GetUploadUrlResponse constructor.
	 *
	 * @param null $uploadUrl
	 */
	public function __construct( $uploadUrl = null ) {
		// using payload to init the object
		if ( is_array( $uploadUrl ) && ! empty( $uploadUrl ) ) {
			parent::__construct( $uploadUrl );
		} else {
			$this->uploadUrl = $uploadUrl;
		}
	}

	/**
	 * @return string
	 */
	public function getUploadUrl() {
		return $this->uploadUrl;
	}
}