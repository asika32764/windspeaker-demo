<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\User;

use Windwalker\Core\Authenticate\User;
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
		if (User::get()->isNull())
		{
			Ioc::getApplication()->redirect(Router::buildHttp('user:login'));
		}

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
	 * getAvatar
	 *
	 * @param int $pk
	 *
	 * @return  string
	 */
	public static function getAvatar($pk = null, $size = 48)
	{
		$user = User::get($pk);

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
