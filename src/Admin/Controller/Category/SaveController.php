<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Category;

use Admin\Blog\Blog;
use Admin\Controller\AbstractAdminController;
use Joomla\Date\Date;
use Windwalker\Core\Router\Router;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Filter\OutputFilter;
use Windwalker\Ioc;

/**
 * The SaveController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends AbstractAdminController
{
	protected function doExecute()
	{
		$data = $this->input->getVar('category');

		$data = new Data($data);

		$data['title'] = trim($data['title']);

		if (!$data['title'])
		{
			$this->setRedirect(Router::build('admin:categories'), 'Title should not be empty', 'danger');

			return false;
		}

		if (!$data['blog'])
		{
			$data['blog'] = Blog::get()->id;
		}

		$data['alias'] = OutputFilter::stringURLSafe(trim($data['title']));
		$data['alias'] = $data['alias'] ? : OutputFilter::stringURLSafe((string) new Date);
		$data['state'] = 1;

		if (!$data['ordering'])
		{
			$max = $this->getMaxOrder($data['blog']);

			$data['ordering'] = $max + 1;
		}

		try
		{
			(new DataMapper('categories'))->saveOne($data);
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::build('admin:categories'), 'Save Error', 'danger');

			return false;
		}

		$this->setRedirect(Router::build('admin:categories'), 'Create success', 'success');

		return true;
	}

	/**
	 * getMaxOrder
	 *
	 * @param integer $blogId
	 *
	 * @return  mixed
	 */
	protected function getMaxOrder($blogId)
	{
		$db = Ioc::getDatabase();

		return $db->setQuery('SELECT max(ordering) FROM categories WHERE blog = ' . $blogId)->loadResult();
	}
}
 