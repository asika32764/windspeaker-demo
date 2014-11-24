<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Category;

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
		$blog = Blog::get();

		try
		{
			$catMapper = new DataMapper('categories');

			$category = $catMapper->findOne($id);

			if ($category->blog != $blog->id)
			{
				throw new ValidFailException('You cannot delete category of other blog.');
			}

			$catMapper->delete(['id' => $id]);
		}
		catch (ValidFailException $e)
		{
			$this->setRedirect(Router::buildHttp('admin:categories'), $e->getMessage(), 'error');

			return false;
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::buildHttp('admin:categories'), 'Delete fail', 'error');

			return false;
		}

		$this->setRedirect(Router::buildHttp('admin:categories'), 'Delete success', 'success');

		return true;
	}
}
 