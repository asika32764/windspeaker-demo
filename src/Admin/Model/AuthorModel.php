<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Model;

use Admin\Form\AuthorDefinition;
use Windwalker\Core\Model\DatabaseModel;
use Windwalker\Form\Form;

/**
 * The AuthorModel class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AuthorModel extends DatabaseModel
{
	/**
	 * getForm
	 *
	 * @param array $data
	 *
	 * @return  Form
	 */
	public function getForm($data = array())
	{
		$form = new Form('author');

		$form->defineFormFields(new AuthorDefinition);

		if ($data)
		{
			$form->bind($data);
		}

		return $form;
	}
}
 