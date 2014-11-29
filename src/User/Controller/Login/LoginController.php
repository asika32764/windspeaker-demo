<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Login;

use Admin\User\UserHelper;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Language\Language;
use Windwalker\Core\Router\Router;
use Windwalker\Core\View\BladeHtmlView;
use Windwalker\Ioc;
use Windwalker\Uri\Uri;
use User\Model\LoginModel;
use User\View\Login\LoginHtmlView;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class LoginController extends Controller
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
		if (UserHelper::isLogin())
		{
			Ioc::getApplication()->redirect(Router::build('admin:dashboard'));
		}

		$model   = new LoginModel;
		$session = Ioc::getSession();

		$user     = $this->input->getVar('user');
		$result   = $model->login($user['username'], $user['password']);
		$package  = $this->getPackage();
		$redirect = $session->get('login.redirect.url');

		if ($result)
		{
			$url = $redirect ? base64_decode($redirect) : $package->get('redirect.login');

			$msg = Language::translate('Login Success');
		}
		else
		{
			$router = Ioc::getRouter();

			$url = $router->build($this->package->getRoutingPrefix() . ':login');

			$msg = Language::translate('Login Fail');
		}

		$uri = new Uri($url);

		if (!$uri->getScheme())
		{
			$url = $this->app->get('uri.base.full') . $url;
		}

		$session->remove('login.redirect.url');

		$this->setRedirect($url, $msg);

		return true;
	}
}
 