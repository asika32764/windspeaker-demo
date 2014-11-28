<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Profile;

use Admin\Controller\AbstractAdminController;
use Admin\Model\ProfileModel;
use Admin\View\Profile\ProfileHtmlView;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Ioc;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends AbstractAdminController
{
	/**
	 * doExecute
	 *
	 * @return  string
	 */
	protected function doExecute()
	{
		$view    = new ProfileHtmlView($this->data);
		$model   = new ProfileModel;
		$session = Ioc::getSession();
		$user    = $session->get('profile.edit.data') ? : User::get();

		$view['item'] = $user;
		$view['form'] = $model->getForm($user);

		return $view->setLayout('edit')->render();
	}
}
 