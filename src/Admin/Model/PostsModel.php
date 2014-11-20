<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Model;

use Windspeaker\Model\ListModel;
use Windwalker\Query\Query;
use Windwalker\Query\QueryElement;

/**
 * The ArticlesModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PostsModel extends ListModel
{
	/**
	 * Property allowFields.
	 *
	 * @var  array
	 */
	protected $allowFields = array();

	/**
	 * Property fieldMapping.
	 *
	 * @var  array
	 */
	protected $fieldMapping = array();

	/**
	 * getListQuery
	 *
	 * @param Query $query
	 *
	 * @return  Query
	 */
	protected function getListQuery(Query $query)
	{
		$queryHelper = $this->getQueryHelper();

		$queryHelper->addTable('post', 'posts')
			->addTable('author', 'authors', 'post.author = author.id')
			->addTable('user',   'users',   'user.id = author.user')
			->addTable('blog',   'blogs',   'post.blog = blog.id');

		$query->select($queryHelper->getSelectFields())
			->where($query->format('%n = %q', 'blog.id', $this['blog.id']))
			->where($query->format('%n = %q', 'type', 'post'));

		$query = $queryHelper->registerQueryTables($query);

		if ($this['list.search'])
		{
			$search[] = $query->format('%n LIKE %q', 'title', '%' . $this['list.search'] . '%');
			$search[] = $query->format('%n LIKE %q', 'alias', '%' . $this['list.search'] . '%');

			$query->where(new QueryElement('()', $search, ' OR '));
		}

		return $query;
	}
}
 