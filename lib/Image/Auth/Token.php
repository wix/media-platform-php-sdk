<?php

namespace Wix\Mediaplatform\Image\Auth;

use Firebase\JWT\JWT;
use Wix\Mediaplatform\Authentication\Jwt\Constants;
use Wix\Mediaplatform\Authentication\NS;
use Wix\Mediaplatform\Image\Option;
use Wix\Mediaplatform\Image\StringToken;
use Wix\Mediaplatform\Image\WatermarkProperties;

/**
 * Class AuthToken
 * @package Wix\Mediaplatform\Image
 */
class Token extends Option {
	/**
	 * @var string
	 */
	const KEY = "token";

	/**
	 * @var string
	 */
	protected $token;

	/**
	 * AuthToken constructor
	 *
	 * @param string $token
	 */
	public function __construct( $token = '' ) {
		parent::__construct( self::KEY );
		if ( $token ) {
			$this->token = $token;
		}
	}

	/**
	 * @param $appId
	 * @param $appSecret
	 * @param $verb
	 *
	 * @param $object
	 *
	 * @param $watermarkProperties WatermarkProperties
	 *
	 * @return string
	 */
	private static function createBaseToken( $appId, $appSecret, $verb, $object, $watermarkProperties = null) {
		$token = new \Wix\Mediaplatform\Authentication\Token();
		$token->setIssuer( NS::APPLICATION . $appId );
		$token->setSubject( NS::APPLICATION . $appId );
		$token->addVerb( NS::SERVICE . $verb );
		$token->setObject( array(
			array(
				$object
			)
		) );

		if(!empty($watermarkProperties)) {
			$token->setAdditionalClaims(
				array(
					WatermarkProperties::KEY => $watermarkProperties->toClaims()
				)
			);
		}

		$claims = $token->toClaims();
		unset( $claims[ Constants::EXPIRATION ] );
		unset( $claims[ Constants::ISSUED_AT ] );
		unset( $claims[ Constants::IDENTIFIER ] );

		return JWT::encode( $claims, $appSecret );
	}

	/**
	 * @return string
	 */
	public function serialize() {
		return self::KEY . StringToken::UNDERSCORE . $this->token;
	}

	/**
	 * @param $params
	 *
	 * @return $this
	 */
	public function deserialize( array $params ) {
		$this->token = (int) $params[0];

		return $this;
	}

	/**
	 * @param $appId string
	 * @param $appSecret string
	 * @param $filePath string
	 * @param $imageHeight int
	 * @param $imageWidth int
	 *
	 * @return string
	 */
	public static function createImageToken( $appId, $appSecret, $filePath, $imageHeight, $imageWidth, $blur = null ) {
		$obj = array(
			"height" => "<=$imageHeight",
			"path"   => $filePath,
			"width"  => "<=$imageWidth",
		);

		if($blur) {
			$obj['blur'] = $blur;
		}

		return self::createBaseToken( $appId, $appSecret, 'image.operations', $obj );
	}

	/**
	 * @param $appId string
	 * @param $appSecret string
	 * @param $filePath string
	 * @param $imageHeight int
	 * @param $imageWidth int
	 *
	 * @return string
	 */
	public static function createOriginalImageToken( $appId, $appSecret, $filePath) {
		return self::createBaseToken( $appId, $appSecret, 'file.download', array(
			"path" => $filePath,
		) );
	}

	/**
	 * @param $appId string
	 * @param $appSecret string
	 * @param $filePath string
	 * @param $imageHeight int
	 * @param $imageWidth int
	 * @param $watermarkProperties WatermarkProperties
	 * @param $blur string
	 *
	 * @return string
	 */
    public static function createWatermarkToken( $appId, $appSecret, $filePath, $imageHeight, $imageWidth, $watermarkProperties, $blur = null) {
	    $obj = array(
		    "path"   => $filePath,
		    "height" => "<=$imageHeight",
		    "width"  => "<=$imageWidth",
	    );

	    if($blur) {
	    	$obj['blur'] = $blur;
	    }

	    return self::createBaseToken( $appId, $appSecret, 'image.watermark', $obj, $watermarkProperties );
    }


}


