<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front;

use Front\Listener\DispatcherListener;
use Front\Listener\SiteListener;
use Windwalker\Core\Package\AbstractPackage;
use Windwalker\Event\Dispatcher;
use Windwalker\Ioc;

/**
 * The FrontPackage class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class FrontPackage extends AbstractPackage
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'front';

	/**
	 * registerListeners
	 *
	 * @param Dispatcher $dispatcher
	 *
	 * @return  void
	 */
	public function registerListeners(Dispatcher $dispatcher)
	{
		parent::registerListeners($dispatcher);

		$dispatcher->addListener(new DispatcherListener);
	}

	/**
	 * loadRouting
	 *
	 * @return  mixed
	 */
	public static function loadRouting()
	{
		$app = Ioc::getApplication();

		// if ($app->get('client') == 'front')
		{
			return parent::loadRouting();
		}

		// return [];
	}
}
 