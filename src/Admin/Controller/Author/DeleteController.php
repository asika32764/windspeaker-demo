<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Author;

use Admin\Blog\Blog;
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

		try
		{
			if (!$id)
			{
				throw new \Exception('Delete fail');
			}

			$author = $authorMapper->findOne($id);

			$blog = Blog::get();

			if ($blog->id != $author->blog)
			{
				throw new ValidFailException('You cannot delete authors of other blog.');
			}

			$authorMapper->delete(['id' => $id]);
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::buildHttp('admin:authors'), 'Delete fail', 'danger');

			return false;
		}

		$this->setRedirect(Router::buildHttp('admin:authors'), 'Delete Author success', 'success');

		return true;
	}
}
 