<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Model;

use Admin\Blog\Blog;
use Admin\Form\PostDefinition;
use Joomla\Date\Date;
use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Filter\OutputFilter;
use Windwalker\Form\Form;
use Windwalker\String\String;

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
	 * @param integer $pk
	 *
	 * @return  \Windwalker\Data\Data
	 */
	public function getItem($pk = null)
	{
		$pk = $pk ? : $this['item.id'];

		if (!$pk)
		{
			return new Data;
		}

		$item = (new DataMapper('posts'))->findOne($pk);

		if ($item->notNull())
		{
			$item->category = (new DataMapper('category_post_maps'))->findColumn('category', ['post' => $item->id]);
		}

		return $item;
	}

	/**
	 * save
	 *
	 * @param Data $data
	 *
	 * @return  mixed|Data
	 */
	public function save(Data $data)
	{
		$data->title = trim($data->title);
		$data->alias = $data->alias ? : OutputFilter::stringURLUnicodeSlug($data->title);

		if (!$data->alias)
		{
			$data->alias = OutputFilter::stringURLSafe((new Date)->toISO8601());
		}

		$mapper = new DataMapper('posts');

		// Increment alias
		$conditions = ['alias' => $data->alias, 'blog' => $data->blog];

		$conditions[] = 'id != ' . ($data->id ? : -1);

		while ($mapper->findOne($conditions)->notNull())
		{
			$conditions['alias'] = $data->alias = String::increment($data->alias, String::INCREMENT_STYLE_DASH);
		}

		$data = $mapper->saveOne($data);

		// Save Categories
		$categories = $data->category ? : [];

		$dataSet = [];

		foreach ($categories as $k => $cat)
		{
			$dataSet[$k]['category'] = $cat;
			$dataSet[$k]['post'] = $data->id;
		}

		(new DataMapper('category_post_maps'))->flush($dataSet, ['post' => $data->id]);

		return $data;
	}

	/**
	 * getForm
	 *
	 * @param array $data
	 *
	 * @return  Form
	 */
	public function getForm($data = array())
	{
		$form = new Form();

		$form->defineFormFields(new PostDefinition(Blog::get()));

		$form->bind($data);

		if ($this['post.type'] == 'static')
		{
			$form->removeField('category');
		}

		return $form;
	}

	/**
	 * validate
	 *
	 * @param Data $data
	 *
	 * @return  bool
	 *
	 * @throws ValidFailException
	 */
	public function validate(Data $data = null)
	{
		if (!trim($data->title))
		{
			throw new ValidFailException('Title not exists.');
		}

		$form = $this->getForm($data);

		if (!$form->validate())
		{
			$errors = $form->getErrors();

			if (count($errors))
			{
				throw new ValidFailException($errors[0]->getMessage());
			}
		}

		return true;
	}
}
