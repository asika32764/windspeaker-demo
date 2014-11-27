<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Form\Field;

use Windwalker\DataMapper\DataMapper;
use Windwalker\Form\Field\ListField;
use Windwalker\Html\Option;

/**
 * The CategoriesField class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class CategoriesField extends ListField
{
	/**
	 * Property blog.
	 *
	 * @var integer
	 */
	protected $blog;

	/**
	 * Method to set property blog
	 *
	 * @param   int $blog
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function setBlog($blog)
	{
		$this->blog = $blog;

		return $this;
	}

	/**
	 * Method to get property Blog
	 *
	 * @return  int
	 */
	public function getBlog()
	{
		return $this->blog;
	}

	/**
	 * prepareOptions
	 *
	 * @return  array|\Windwalker\Html\Option[]
	 */
	protected function prepareOptions()
	{
		$options = array();

		$cats = (new DataMapper('categories'))->find(['blog' => $this->blog]);

		foreach ($cats as $cat)
		{
			$options[] = new Option($cat->title, $cat->id);
		}

		return $options;
	}
}
