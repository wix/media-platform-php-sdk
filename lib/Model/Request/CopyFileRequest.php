<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 24/05/2017
 * Time: 18:05
 */

namespace Wix\Mediaplatform\Model\Request;


use Wix\Mediaplatform\Model\Job\Destination;
use Wix\Mediaplatform\Model\Job\Source;

/**
 * Class CreateFileRequest
 * @package Wix\Mediaplatform\Model\Request
 */
class CopyFileRequest extends BaseRequest
{
    /**
     * @var Source
     */
    protected $source;

    /**
     * @var Destination
     */
    protected $destination;

	/**
	 * @return Source
	 */
	public function getSource() {
		return $this->source;
	}

	/**
	 * @param Source $source
	 *
	 * @return CopyFileRequest
	 */
	public function setSource( $source ) {
		$this->source = $source;

		return $this;
	}

	/**
	 * @return Destination
	 */
	public function getDestination() {
		return $this->destination;
	}

	/**
	 * @param Destination $destination
	 *
	 * @return CopyFileRequest
	 */
	public function setDestination( $destination ) {
		$this->destination = $destination;

		return $this;
	}

}