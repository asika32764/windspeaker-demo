<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Blog;

use Admin\Form\BlogDefinition;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Router\Router;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Filter\OutputFilter;
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
	 * Property blog.
	 *
	 * @var Data
	 */
	protected $blog;

	/**
	 * Property author.
	 *
	 * @var Data
	 */
	protected $author;

	/**
	 * Execute the controller.
	 *
	 * @throws \Exception
	 * @return  mixed Return executed result.
	 */
	public function execute()
	{
		$user = User::get($this->input->get('user_id'));

		$blog = $this->input->getVar('blog');

		$blog = new Data($blog);

		$isNew = !$blog->id;

		$blog->state = 1;
		$blog->alias = OutputFilter::stringURLSafe($blog->alias);

		if (!$this->validate($blog))
		{
			return false;
		}

		$trans = Ioc::getDatabase()->getTransaction()->start();

		try
		{
			$this->blog = (new DataMapper('blogs'))->saveOne($blog, 'id');

			if ($isNew)
			{
				$author['user'] = $user->id;
				$author['blog'] = $this->blog->id;
				$author['owner'] = 1;
				$author['admin'] = 1;

				$this->author = (new DataMapper('authors'))->createOne($author);
			}

			$trans->commit();
		}
		catch (\Exception $e)
		{
			$trans->rollback();

			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::buildHttp('admin:blog', ['id' => $blog->id ? : '']), 'Save fail', 'danger');

			return true;
		}

		$this->setRedirect(Router::buildHttp('admin:blogs'), 'Save Success', 'success');

		return true;
	}

	/**
	 * validate
	 *
	 * @param Data $data
	 *
	 * @return  boolean
	 */
	protected function validate($data)
	{
		$form = new Form('blog');
		$form->defineFormFields(new BlogDefinition);

		$form->bind($data);

		if (!$form->validate())
		{
			$errors = $form->getErrors();

			foreach ($errors as $error)
			{
				$this->addFlash($error->getMessage(), 'danger');
			}

			$this->setRedirect(Router::buildHttp('admin:blog', ['id' => $data->id ? : '']));

			return false;
		}

		// Check exists
		$conditions['alias'] = $data['alias'];

		if ($data->id)
		{
			$conditions[] = 'id != ' . $data->id;
		}

		$blog = (new DataMapper('blogs'))->findOne($conditions);

		if ($blog->notNull())
		{
			$this->setRedirect(Router::buildHttp('admin:blog', ['id' => $data->id ? : '']), 'Blog Name has already been used', 'danger');

			return false;
		}

		return true;
	}

	/**
	 * Method to get property Blog
	 *
	 * @return  Data
	 */
	public function getBlog()
	{
		return $this->blog;
	}

	/**
	 * Method to get property Author
	 *
	 * @return  Data
	 */
	public function getAuthor()
	{
		return $this->author;
	}
}
 