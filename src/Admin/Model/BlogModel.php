<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Model;

use Windwalker\Core\Model\DatabaseModel;
use Windwalker\DataMapper\DataMapper;
use Windwalker\DataMapper\RelationDataMapper;

/**
 * The BlogModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class BlogModel extends DatabaseModel
{
	/**
	 * getCurrentBlog
	 *
	 * @param integer $user
	 * @param integer $pk
	 *
	 * @return  mixed
	 */
	public function getCurrentBlog($user, $pk = null)
	{
		$pk = $pk ? : $this['item.id'];

		$mapper = (new RelationDataMapper('blog', 'blogs'))
			->addTable('author', 'authors', 'author.blog = blog.id')
			->addTable('user', 'users', 'user.id = author.user');

		$conditions = [];

		if ($pk)
		{
			$conditions['blog.id'] = $pk;
		}

		$conditions[] = 'blog.state >= 1';
		$conditions[] = 'user.id = ' . $user;

		if ($this->get('user.isAdmin', true))
		{
			$conditions[] = '(author.admin >= 1 OR author.owner >= 1)';
		}

		return $mapper->findOne($conditions);
	}

	/**
	 * getBlog
	 *
	 * @param integer $pk
	 *
	 * @return  mixed
	 */
	public function getBlog($pk = null)
	{
		return $this->fetch('blog', function() use ($pk)
		{
			$pk = $pk ? : $this['item.id'];

			return (new DataMapper('blogs'))->findOne($pk);
		});
	}
}
 