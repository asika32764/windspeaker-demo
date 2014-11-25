<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Register;

use Windwalker\Core\Controller\Controller;
use User\Model\LoginModel;
use User\Model\RegistrationModel;
use User\View\Registration\RegistrationHtmlView;
use Windwalker\Core\Ioc;
use Windwalker\Data\Data;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends Controller
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
		$model = new RegistrationModel;

		$view = new RegistrationHtmlView;

		$session = Ioc::getSession();

		$view['item'] = $session['register.form.data'] ? : array();
		$view['item'] = new Data($view['item']);

		return $view->render();
	}
}
 