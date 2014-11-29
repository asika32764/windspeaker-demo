<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Logout;

use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use User\Model\LoginModel;
use Windwalker\Core\Ioc;
use Windwalker\Core\Router\Router;

/**
 * The SaveController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends Controller
{
	/**
	 * Execute the controller.
	 *
	 * @return  mixed Return executed result.
	 *
	 * @throws  \LogicException
	 * @throws  \RuntimeException
	 */
	public function execute()
	{
		$model = new LoginModel;

		$user = User::get();

		if ($user->isNull())
		{
			$this->setRedirect('login', 'Already logout', 'success');
		}

		$model->logout($user->username);

		// Session
		$session = Ioc::getSession();
		$session->remove('current.blog');

		$this->setRedirect(Router::buildHttp('front:home'), 'Logout success', 'success');

		return true;
	}
}
 