<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Login;

use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Router\Router;
use Windwalker\Ioc;
use User\Model\LoginModel;
use User\View\Login\LoginHtmlView;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class IndexController extends Controller
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
		$user = User::get();

		if (!$user->isNull())
		{
			Ioc::getApplication()->redirect(Router::build('admin:dashboard'));
		}

		$model = new LoginModel;

		$view = new LoginHtmlView;

		$view['form'] = $model->getForm();

		return $view->render();
	}
}
