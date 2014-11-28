<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Listener;

use Admin\User\UserHelper;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Event\Event;
use Windwalker\Ioc;
use Windwalker\Uri\Uri;

/**
 * The DispatcherListaner class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DispatcherListener
{
	/**
	 * onBeforeRouting
	 *
	 * @param Event $event
	 *
	 * @return  void
	 *
	 * @throws \Exception
	 */
	public function onBeforeRouting(Event $event)
	{
		$app = Ioc::getApplication();

		$uri = $app->initUri();

		$uri  = new Uri(strtolower($uri->full));
		$host = $uri->getHost();
		$host = explode('.', $host);

		array_pop($host);
		array_pop($host);

		$alias = implode('.', $host);
		$alias = trim(str_replace('.', '', $alias));

		// If is main domain but logged in, go to admin
		if (!$alias && UserHelper::isLogin())
		{
			$app->set('client', 'admin');

			return;
		}

		// Has subdomain, means it is users' blog
		if ($alias)
		{
			$blogMapper = new DataMapper('blogs');

			$blog = $blogMapper->findOne(['alias' => $alias]);

			if ($blog->isNull())
			{
				throw new \Exception('Blog not found', 404);
			}

			Ioc::getContainer('front')->set('current.blog', $blog);

			$app->set('client', 'front');

			return;
		}

		// Main domain, got to site
		$app->set('client', 'site');
	}

	/**
	 * onBeforeRouting
	 *
	 * @param Event $event
	 *
	 * @return  void
	 *
	 * @throws \Exception
	 */
	public function onAfterRouting(Event $event)
	{
		$app = Ioc::getApplication();
		$controller = Ioc::get('main.controller');

		$route = $app->get('uri.route');

		if (trim($route, '/'))
		{
			return;
		}

		Ioc::getContainer()->share('main.controller', $controller);
	}
}
