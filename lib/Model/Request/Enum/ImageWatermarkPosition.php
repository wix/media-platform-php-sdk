<?php
/**
 * Created by PhpStorm.
 * User: leong
 * Date: 08/02/2018
 * Time: 11:22
 */

namespace Wix\Mediaplatform\Model\Request\Enum;


class ImageWatermarkPosition {
	const NORTHWEST = 1;
	const NORTH = 2;
	const NORTHEAST = 3;
	const WEST = 4;
	const CENTER = 5; // Default
	const EAST = 6;
	const SOUTHWEST = 7;
	const SOUTH = 8;
	const SOUTHEAST = 9;
	const TEXTURE = 10; // Tile
}