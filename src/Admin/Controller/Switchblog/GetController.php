<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Switchblog;

use Admin\Model\BlogModel;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Ioc;
use Windwalker\Core\Router\Router;

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
		$id = $this->input->get('id');
		$return = $this->input->get('return');
		$return = $return ? base64_decode($return) : Router::build('admin:dashboard');

		$user = User::get();

		$blogModel = new BlogModel;

		$blog = $blogModel->getCurrentBlog($user->id, $id);

		$session = Ioc::getSession();

		if (!$blog->isNull())
		{
			$session->set('current.blog', $blog->id);
		}

		$this->setRedirect($return);

		return true;
	}
}
