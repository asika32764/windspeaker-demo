<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\User;

use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Cache\CacheFactory;
use Windwalker\Core\Router\Router;
use Windwalker\Ioc;

/**
 * The UserHelper class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class UserHelper
{
	/**
	 * checkLogin
	 *
	 * @return  boolean
	 */
	public static function checkLogin()
	{
		if (User::get()->notNull())
		{
			return true;
		}

		$session = Ioc::getSession();
		$current = Ioc::getConfig()->get('uri.current');
		$current = base64_encode($current);

		$session->set('login.redirect.url', $current);

		Ioc::getApplication()->redirect(Router::buildHttp('user:login'));

		return true;
	}

	/**
	 * isLogin
	 *
	 * @param integer $user
	 *
	 * @return  bool
	 */
	public static function isLogin($user = null)
	{
		return !User::get($user)->isNull();
	}

	/**
	 * get
	 *
	 * @param int $pk
	 *
	 * @return  \Windwalker\Data\Data
	 */
	public static function get($pk = null)
	{
		if (!$pk)
		{
			return User::get();
		}

		$cache = CacheFactory::getCache('user');

		$key = 'user.' . $pk;

		if ($cache->exists($key))
		{
			return $cache->get($key);
		}

		$user = User::get($pk);

		$cache->set($key, $user);

		return $user;
	}

	/**
	 * getAvatar
	 *
	 * @param int $pk
	 *
	 * @return  string
	 */
	public static function getAvatar($pk = null, $size = 48)
	{
		$user = UserHelper::get($pk);

		if ($user->image)
		{
			return $user->image;
		}

		return static::getGavatar($user->email, $size);
	}

	/**
	 * getGavatar
	 *
	 * @param string $email
	 * @param int    $size
	 *
	 * @return  string
	 */
	public static function getGavatar($email, $size = 48)
	{
		$hash = md5(strtolower(trim($email)));

		return 'http://www.gravatar.com/avatar/' . $hash . '?d=mm&s=' . $size;
	}
}
