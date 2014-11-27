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
 * The AuthorsModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AuthorsModel extends ListModel
{
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

		$queryHelper->addTable('author', 'authors')
			->addTable('user', 'users', 'user.id = author.user')
			->addTable('blog', 'blogs', 'blog.id = author.blog');

		$query->select($queryHelper->getSelectFields());

		if ($this['blog.id'])
		{
			$query->where($query->format('%n = %q', 'blog.id', $this['blog.id']));
		}

		if ($this['find.query'])
		{
			$q = '%' . $this['find.query'] . '%';

			$conditions[] = $query->format('%n LIKE %q', 'user.username', $q);
			$conditions[] = $query->format('%n LIKE %q', 'user.fullname', $q);
			$conditions[] = $query->format('%n LIKE %q', 'user.email', $q);
			$conditions[] = $query->format('%n LIKE %q', 'author.name', $q);

			$query->where(new QueryElement('()', $conditions, ' OR '));
		}

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
 