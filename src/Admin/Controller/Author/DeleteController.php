<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Author;

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

		$authorMapper = new DataMapper('authors');

		$return = $this->input->getBase64('return');

		$return = $return ? base64_decode($return) : Router::buildHttp('admin:authors');

		try
		{
			if (!$id)
			{
				throw new \Exception('Delete fail');
			}

			$author = $authorMapper->findOne($id);

			$blog = Blog::get();
			$user = User::get();

			if ($author->owner)
			{
				throw new ValidFailException('You cannot delete owner.');
			}

			if ($user->id != $author->user && $blog->id != $author->blog)
			{
				throw new ValidFailException('You cannot delete authors of other blog.');
			}

			$authorMapper->delete(['id' => $id]);
		}
		catch (ValidFailException $e)
		{
			$this->setRedirect($return, $e->getMessage(), 'danger');

			return false;
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect($return, 'Delete fail', 'danger');

			return false;
		}

		$this->setRedirect($return, 'Remove Author success', 'success');

		return true;
	}
}
