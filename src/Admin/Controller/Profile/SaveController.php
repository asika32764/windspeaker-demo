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
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Router\Router;
use Windwalker\Crypt\Password;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Ioc;
use Windwalker\Record\Record;

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
		$session = Ioc::getSession();

		$user = $this->input->getVar('user', array());
		$user = new Data($user);

		$user->id = User::get()->id;
		$user->username = User::get()->username;

		// Store Session
		$temp = clone $user;
		unset($temp->password);
		unset($temp->password2);

		$session->set('profile.edit.data', $temp);

		try
		{
			if (!$this->validate($user))
			{
				return false;
			}

			$record = new Record('users');

			$record->load($user->id);
			$record->bind($user)
				->check()
				->store(true);
		}
		catch (ValidFailException $e)
		{
			$this->setRedirect(Router::buildHttp('admin:profile', ['id' => $user->id ? : '']), $e->getMessage(), 'danger');

			return true;
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
		unset($user->password);
		unset($user->password2);
		$session->set('user', $user);
		$session->remove('profile.edit.data');

		$this->setRedirect(Router::buildHttp('admin:profile'), 'Save Success', 'success');

		return true;
	}

	/**
	 * validate
	 *
	 * @param Data $data
	 *
	 * @throws  ValidFailException
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

		if ($data->password)
		{
			if ($data->password2 != $data->password)
			{
				throw new ValidFailException('Password not match');
			}

			$password = new Password;

			$data->password = $password->create($data->password);
		}

		return true;
	}
}
 