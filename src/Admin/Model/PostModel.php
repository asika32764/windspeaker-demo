<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Model;

use Admin\Form\PostDefinition;
use Windwalker\Core\Model\DatabaseModel;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Form\Form;

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

		return (new DataMapper('posts'))->findOne($pk);
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
		$form = new Form('user');

		$form->defineFormFields(new PostDefinition);

		$form->bind($data);

		return $form;
	}
}
