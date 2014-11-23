<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Blog;

use Admin\Blog\Blog;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Router\Router;
use Windwalker\DataMapper\DataMapper;

/**
 * The DeleteController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DeleteController extends Controller
{
	/**
	 * Execute the controller.
	 *
	 * @throws \Exception
	 * @return  mixed Return executed result.
	 */
	public function execute()
	{
		$id = $this->input->get('id');

		$blogMapper = new DataMapper('blogs');

		try
		{
			if (!$id)
			{
				throw new \Exception('Delete fail');
			}

			$author = (new DataMapper('authors'))->findOne(['blog' => $id, 'user' => User::get()->id]);

			if (!$author->owner)
			{
				throw new ValidFailException('Only owner can remove blog.');
			}

			$blogMapper->delete(['id' => $id]);
		}
		catch (ValidFailException $e)
		{
			$this->setRedirect(Router::buildHttp('admin:blogs'), $e->getMessage(), 'danger');

			return false;
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::buildHttp('admin:blogs'), 'Delete fail', 'danger');

			return false;
		}

		$this->setRedirect(Router::buildHttp('admin:blogs'), 'Delete Blog success', 'success');

		return true;
	}
}
 