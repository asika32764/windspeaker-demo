<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Author;

use Admin\Blog\Blog;
use Admin\User\UserHelper;
use Windwalker\Cache\Cache;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Cache\CacheFactory;
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
	 * Property instances.
	 *
	 * @var  Cache
	 */
	static $cache = null;

	/**
	 * get
	 *
	 * @param integer $user
	 * @param integer $blog
	 *
	 * @return  mixed|Data
	 */
	public static function get($user, $blog)
	{
		$cache = CacheFactory::getCache('author');

		$key = 'author.' . $user . '.' . $blog;

		if ($cache->exists($key))
		{
			return $cache->get($key);
		}

		$author = (new DataMapper('authors'))->findOne(['user' => $user, 'blog' => $blog]);

		if ($author->user)
		{
			$user = User::get($author->user);

			$author->name        = $user->fullname;
			$author->description = $user->description;
			$author->image       = $user->image;
			$author->website     = $user->website;
		}

		$cache->set('author.' . $author->id, $author);
		$cache->set($key, $author);

		return $author;
	}

	/**
	 * get
	 *
	 * @param int $id
	 *
	 * @return  mixed|Data
	 */
	public static function getPostAuthor($id)
	{
		$cache = CacheFactory::getCache('author');

		if ($cache->exists('author.' . $id))
		{
			return $cache->get('author.' . $id);
		}

		$author = (new DataMapper('authors'))->findOne($id);

		if ($author->user)
		{
			$user = User::get($author->user);

			$author->name        = $user->fullname;
			$author->description = $user->description;
			$author->image       = $user->image;
			$author->website     = $user->website;

			$author->image = $author->image ? : UserHelper::getGavatar($user->email, 200);
		}

		$cache->set('author.' . $id, $author);
		$cache->set('author.' . $author->user . '.' . $author->blog, $author);

		return $author;
	}

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
 