<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Author;

use Admin\Author\Author;
use Admin\Blog\Blog;
use Admin\Controller\AbstractAdminController;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Router\Router;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\UUID\Uuid;

/**
 * The SaveController class.
 *
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends AbstractAdminController
{
	/**
	 * Property isNew.
	 *
	 * @var boolean
	 */
	protected $isNew = false;

	/**
	 * doExecute
	 *
	 * @throws  ValidFailException
	 * @throws  \Exception
	 * @return  boolean
	 */
	protected function doExecute()
	{
		try
		{
			// If we add a user as an author
			$username = $this->input->getUsername('username');

			$username = trim($username);

			if ($username)
			{
				$this->isNew = true;

				return $this->createUser($username);
			}

			// Change Permission
			$permission = $this->input->get('permission');

			$permission = trim($permission);

			if ($permission)
			{
				return $this->permission($permission);
			}

			// Save an manual Author
			$data = $this->input->getVar('author');

			$data = new Data($data);

			return $this->saveAuthor($data);
		}
		catch (ValidFailException $e)
		{
			$this->setRedirect(Router::buildHttp('admin:authors'), $e->getMessage(), 'danger');

			return false;
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::buildHttp('admin:authors'), 'Save fail', 'danger');

			return false;
		}
	}

	/**
	 * create
	 *
	 * @param string $username
	 *
	 * @throws  ValidFailException
	 * @throws  \Exception
	 * @return  boolean
	 */
	protected function createUser($username)
	{
		$authorMapper = new DataMapper('authors');

		if (!$username)
		{
			throw new ValidFailException('Please enter username');
		}

		$blog = Blog::get();
		$user = User::get(['username' => $username]);

		if ($user->isNull())
		{
			throw new ValidFailException('User not exists');
		}

		if (!$authorMapper->findOne(['user' => $user->id, 'blog' => $blog->id])->isNull())
		{
			$this->setRedirect(Router::buildHttp('admin:authors'), 'Author already exists', 'success');

			return true;
		}

		$data['user'] = $user->id;
		$data['blog'] = $blog->id;

		(new DataMapper('authors'))->saveOne($data);

		$this->setRedirect(Router::buildHttp('admin:authors'), 'Save success', 'success');

		return true;
	}

	/**
	 * update
	 *
	 * @param Data $data
	 *
	 * @return  bool
	 *
	 * @throws ValidFailException
	 */
	protected function saveAuthor($data)
	{
		if (!$data->name)
		{
			throw new ValidFailException('Name should not be empty.');
		}

		if (!$data->image)
		{
			unset($data->image);
		}

		$isNew = !$data->id;

		if ($isNew)
		{
			$data->uuid = $data->uuid ? : Uuid::v4();
		}

		$data->blog = Blog::get()->id;

		$authorMapper = new DataMapper('authors');

		$authorMapper->saveOne($data, 'id');

		$this->setRedirect(Router::buildHttp('admin:authors'), 'Save success', 'success');

		return true;
	}

	/**
	 * permission
	 *
	 * @param string $permission
	 *
	 * @throws  ValidFailException
	 * @return  boolean
	 */
	protected function permission($permission)
	{
		$authorMapper = new DataMapper('authors');

		$id = $this->input->get('id');

		$author = $authorMapper->findOne($id);

		if ($author->blog != Blog::get()->id)
		{
			throw new ValidFailException('You cannot change permission of author which in other blog.');
		}

		if ($author->owner)
		{
			throw new ValidFailException('You cannot change permission of blog owner');
		}

		$author['admin'] = ($permission == Author::ADMIN) ? 1 : 0;

		$authorMapper->updateOne($author, 'id');

		$this->setRedirect(Router::buildHttp('admin:authors'), 'Save success', 'success');

		return true;
	}
}
 