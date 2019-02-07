<?php

namespace Wix\Mediaplatform\Image\Auth;

use Firebase\JWT\JWT;
use Wix\Mediaplatform\Authentication\Jwt\Constants;
use Wix\Mediaplatform\Authentication\NS;
use Wix\Mediaplatform\Image\Option;
use Wix\Mediaplatform\Image\StringToken;

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
	 * @return string
	 */
	private static function createBaseToken( $appId, $appSecret, $verb, $object ) {
		$token = new \Wix\Mediaplatform\Authentication\Token();
		$token->setIssuer( NS::APPLICATION . $appId );
		$token->setSubject( NS::APPLICATION . $appId );
		$token->addVerb( NS::SERVICE . $verb );
		$token->setObject( array(
			array(
				$object
			)
		) );


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
	public static function createImageToken( $appId, $appSecret, $filePath, $imageHeight, $imageWidth ) {

		return self::createBaseToken( $appId, $appSecret, 'image.operations', array(
			"height" => "<=$imageHeight",
			"path"   => $filePath,
			"width"  => "<=$imageWidth",
		) );
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
	public static function createOriginalImageToken( $appId, $appSecret, $filePath ) {
		return self::createBaseToken( $appId, $appSecret, 'file.download', array(
			"path" => $filePath,
		) );
	}


}
