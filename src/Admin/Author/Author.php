<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Author;

use Admin\Blog\Blog;
use Windwalker\Core\Authenticate\User;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Ioc;

/**
 * The Author class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class Author
{
	const OWNER = 'owner';
	const ADMIN = 'admin';
	const MEMBER = 'member';

	/**
	 * checkPermission
	 *
	 * @param string $type
	 * @param Data   $blog
	 * @param Data   $user
	 *
	 * @return  boolean
	 */
	public static function checkPermission($type = self::ADMIN, Data $blog = null, Data $user = null)
	{
		$user = $user ? : User::get();
		$blog = $blog ? : Blog::get();

		// TODO: cache it.
		$author = (new DataMapper('authors'))->findOne(['user' => $user->id, 'blog' => $blog->id]);

		if ($author->isNull())
		{
			return false;
		}

		switch ($type)
		{
			case static::OWNER:
				return (bool) $author->owner;
				break;

			case static::ADMIN:
				return ((bool) $author->owner || (bool) $author->admin);
				break;

			default:
			case static::MEMBER:
				return (!$author->owner && !$author->admin);
				break;
		}
	}

	/**
	 * isOwner
	 *
	 * @param Data $blog
	 * @param Data $user
	 *
	 * @return  bool
	 */
	public static function isOwner(Data $blog = null, Data $user = null)
	{
		return static::checkPermission(static::OWNER, $blog, $user);
	}

	/**
	 * isAdmin
	 *
	 * @param Data $blog
	 * @param Data $user
	 *
	 * @return  bool
	 */
	public static function isAdmin(Data $blog = null, Data $user = null)
	{
		return static::checkPermission(static::ADMIN, $blog, $user);
	}

	/**
	 * isMember
	 *
	 * @param Data $blog
	 * @param Data $user
	 *
	 * @return  bool
	 */
	public static function isMember(Data $blog = null, Data $user = null)
	{
		return static::checkPermission(static::MEMBER, $blog, $user);
	}
}
 