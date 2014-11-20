<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Settings;

use Admin\Form\BlogDefinition;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Router\Router;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Form\Form;
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
	 * @return  mixed Return executed result.
	 *
	 * @throws  \LogicException
	 * @throws  \RuntimeException
	 */
	public function execute()
	{
		$blog = $this->input->getVar('blog');

		$form = new Form('blog');
		$form->defineFormFields(new BlogDefinition);

		$form->bind($blog);

		if (!$form->validate())
		{
			$errors = $form->getErrors();

			foreach ($errors as $error)
			{
				$this->addFlash($error->getMessage(), 'danger');
			}

			$this->setRedirect(Router::build('admin:settings'));

			return false;
		}

		$blog = (new DataMapper('blogs'))->updateOne($blog, 'id');

		$this->setRedirect(Router::build('admin:settings'), 'Save Success', 'success');

		return true;
	}
}
 