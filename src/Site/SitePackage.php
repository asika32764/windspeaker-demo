<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Site;

use Windwalker\Core\Package\AbstractPackage;
use Windwalker\Ioc;

/**
 * The SitePackage class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SitePackage extends AbstractPackage
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'site';

	/**
	 * loadRouting
	 *
	 * @return  mixed
	 */
	public static function loadRouting()
	{
		$app = Ioc::getApplication();

		if ($app->get('client') == 'site')
		{
			return parent::loadRouting();
		}

		return [];
	}
}
