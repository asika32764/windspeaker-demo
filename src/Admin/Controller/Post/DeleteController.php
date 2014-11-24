<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Post;

use Admin\Author\Author;
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
		$user = User::get();
		$blog = Blog::get();

		try
		{
			if (!$id)
			{
				throw new ValidFailException('No ID');
			}

			if (!Author::isAdmin())
			{
				throw new ValidFailException('Access deny');
			}

			$postMapper = new DataMapper('posts');

			$post = $postMapper->findOne($id);

			if ($post->blog != $blog->id)
			{
				throw new ValidFailException('You cannot delete post of other blog.');
			}

			$postMapper->delete(['id' => $id]);
		}
		catch (ValidFailException $e)
		{
			$this->setRedirect(Router::buildHttp('admin:posts'), $e->getMessage(), 'danger');

			return false;
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::buildHttp('admin:posts'), 'Delete fail', 'danger');

			return false;
		}

		$this->setRedirect(Router::buildHttp('admin:posts'), 'Delete success', 'success');

		return true;
	}
}
 