<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Site\Banner;

/**
 * The Banner class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Banner
{
	/**
	 * getBanners
	 *
	 * @param int $total
	 *
	 * @return  array
	 */
	public static function getBanners($total = 5)
	{
		$banners = [];

		foreach (range(1, $total) as $i)
		{
			$banners[] = 'https://windspeaker.s3.amazonaws.com/banners/banner-' . $i . '.jpg';
		}

		return $banners;
	}
}
