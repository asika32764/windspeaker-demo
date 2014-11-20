<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Blog;

use Admin\Model\BlogModel;
use Windwalker\Core\Authenticate\User;
use Windwalker\Data\Data;
use Windwalker\Ioc;

/**
 * The Blog class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Blog
{
	/**
	 * Property blog.
	 *
	 * @var string
	 */
	protected static $blog;

	/**
	 * getBlog
	 *
	 * @return  Data
	 */
	public static function getBlog()
	{
		if (static::$blog)
		{
			return static::$blog;
		}

		$session = Ioc::getSession();

		$blogId = $session->get('current.blog');

		$blogModel = new BlogModel;

		$user = User::get();

		if ($user->isNull())
		{
			throw new \RuntimeException('No user');
		}

		$blog = $blogModel->getCurrentBlog($user->id, $blogId);

		$session->set('current.blog', $blog->id);

		return static::$blog = $blog;
	}
}
 