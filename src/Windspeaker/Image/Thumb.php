<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Windspeaker\Image;

use Joomla\Image\Image;
use Windwalker\Filesystem\Folder;

/**
 * The Thumb class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Thumb
{
	/**
	 * createThumb
	 *
	 * @param string $src
	 *
	 * @return  bool
	 */
	public static function createThumb($src, $width = 400, $height = 400)
	{
		$dest = new \SplFileInfo(WINDWALKER_CACHE . '/image/temp/' . md5($src));

		Folder::create($dest->getPath());

		$image = new Image;
		$image->loadFile($src);
		$image->cropResize($width, $height, false);
		$image->toFile($dest->getPathname() . '.jpg');

		return $dest->getPathname() . '.jpg';
	}
}
