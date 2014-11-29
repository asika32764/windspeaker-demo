<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Listener;

use Admin\AdminPackage;
use Admin\User\UserHelper;
use Windwalker\Core\Controller\Controller;
use Windwalker\Event\Event;
use Windwalker\Ioc;

/**
 * The UserListener class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class UserListener
{
	/**
	 * onAfterRouting
	 *
	 * @param Event $event
	 *
	 * @return  void
	 */
	public function onAfterRouting(Event $event)
	{
		$app = Ioc::getApplication();
		$controller = Ioc::get('main.controller');

		if ($controller->getPackage() instanceof AdminPackage)
		{
			// Check is logged-in or redirect to login page
			UserHelper::checkLogin();
		}
	}
}
