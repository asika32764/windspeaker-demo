<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Listener;

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

		if (!count($host))
		{
			$app->set('client', 'admin');

			return;
		}

		$alias = array_shift($host);

		$blogMapper = new DataMapper('blogs');

		$blog = $blogMapper->findOne(['alias' => $alias]);

		if ($blog->isNull())
		{
			throw new \Exception('Blog not found');
		}

		Ioc::getContainer('front')->set('current.blog', $blog);

		$app->set('client', 'front');
	}
}
