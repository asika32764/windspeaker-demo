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
use Windwalker\Data\Data;
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
		$ctrl = new \Admin\Controller\Blog\SaveController($this->input, $this->app);

		if (!$ctrl->execute())
		{
			list($url, $msg, $type) = $ctrl->getRedirect(true);

			$this->setRedirect($url, $msg, $type);

			return false;
		}

		list($url, $msg, $type) = $ctrl->getRedirect(true);

		$this->setRedirect(Router::buildHttp('admin:settings'), $msg, $type);

		return true;
	}
}
 