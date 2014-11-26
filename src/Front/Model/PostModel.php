<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Model;

use Windwalker\Core\Model\DatabaseModel;
use Windwalker\DataMapper\DataMapper;

/**
 * The PostModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PostModel extends DatabaseModel
{
	/**
	 * getItem
	 *
	 * @param $pk
	 *
	 * @return  mixed|\Windwalker\Data\Data
	 */
	public function getItem($pk)
	{
		$pk = $pk ? : $this['item.id'];

		return (new DataMapper('posts'))->findOne($pk);
	}
}
 