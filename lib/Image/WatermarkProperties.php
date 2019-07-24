<?php

namespace Wix\Mediaplatform\Image;

class WatermarkProperties {
	const KEY = "wmk";

	/**
	 * @var string
	 */
	private $path;

	/**
	 * @var int
	 */
	private $opacity;

	/**
	 * @var float
	 */
	private $proportions;

	/**
	 * @var Gravity
	 */
	private $gravity;

	/**
	 * WatermarkProperties constructor.
	 *
	 * @param string $path
	 * @param int $opacity
	 * @param float $proportions
	 * @param string $gravity
	 */
	public function __construct( $path, $opacity, $proportions, $gravity ) {
		$this->path        = $path;
		$this->opacity     = $opacity;
		$this->proportions = $proportions;
		$this->gravity     = $gravity;
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
	 * @return WatermarkProperties
	 */
	public function setPath( $path ) {
		$this->path = $path;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getOpacity() {
		return $this->opacity;
	}

	/**
	 * @param int $opacity
	 *
	 * @return WatermarkProperties
	 */
	public function setOpacity( $opacity ) {
		$this->opacity = $opacity;

		return $this;
	}

	/**
	 * @return float
	 */
	public function getProportions() {
		return $this->proportions;
	}

	/**
	 * @param float $proportions
	 *
	 * @return WatermarkProperties
	 */
	public function setProportions( $proportions ) {
		$this->proportions = $proportions;

		return $this;
	}

	/**
	 * @return Gravity
	 */
	public function getGravity() {
		return $this->gravity;
	}

	/**
	 * @param Gravity $gravity
	 *
	 * @return WatermarkProperties
	 */
	public function setGravity( $gravity ) {
		$this->gravity = $gravity;

		return $this;
	}

	/**
	 * @return array
	 */
	public function toClaims() {
		$claims = array();

		$claims["path"] = $this->getPath();
		$claims["opacity"] = $this->getOpacity();
		$claims["proportions"] = $this->getProportions();
		$claims["gravity"] = $this->getGravity();

		return $claims;
	}
}