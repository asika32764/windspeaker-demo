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

/**
 * The CategoryModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CategoryModel extends DatabaseModel
{
	public function getItem($pk = null)
	{
		$pk = $pk ? : $this['item.id'];

		return (new DataMapper('categories'))->findOne($pk);
	}
}
