<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Profile;

use Admin\Model\ProfileModel;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Router\Router;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Ioc;

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
	 * @throws \Exception
	 * @return  mixed Return executed result.
	 */
	public function execute()
	{
		$user = $this->input->getVar('user', array());

		$user = new Data($user);

		$user->id = User::get()->id;
		$user->username = User::get()->username;

		if (!$this->validate($user))
		{
			return false;
		}

		try
		{
			$user = (new DataMapper('users'))->saveOne($user, 'id');
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::buildHttp('admin:profile', ['id' => $user->id ? : '']), 'Save fail', 'danger');

			return true;
		}

		// Save success, reset user session
		$session = Ioc::getSession();

		$session->set('user', $user);

		$this->setRedirect(Router::buildHttp('admin:profile'), 'Save Success', 'success');

		return true;
	}

	/**
	 * validate
	 *
	 * @param Data $data
	 *
	 * @return  boolean
	 */
	protected function validate($data)
	{
		$model = new ProfileModel;

		$form = $model->getForm($data);

		if (!$form->validate())
		{
			$errors = $form->getErrors();

			foreach ($errors as $error)
			{
				$this->addFlash($error->getMessage(), 'danger');
			}

			$this->setRedirect(Router::buildHttp('admin:profile', ['id' => $data->id ? : '']));

			return false;
		}

		return true;
	}
}
 