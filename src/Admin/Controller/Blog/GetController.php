<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Blog;

use Admin\Controller\AbstractAdminController;
use Admin\Form\BlogDefinition;
use Admin\View\Settings\SettingsHtmlView;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Form\Form;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends AbstractAdminController
{
	/**
	 * doExecute
	 *
	 * @return  mixed
	 */
	protected function doExecute()
	{
		$id = $this->input->get('id');

		$blog = $id ? (new DataMapper('blogs'))->findOne($id) : new Data;

		$blog->params = json_decode($blog->params);

		$view = new SettingsHtmlView($this->data);

		$form = new Form('blog');
		$form->defineFormFields(new BlogDefinition);

		$form->bind($blog);

		$view['form'] = $form;
		$view['item'] = $blog;

		return $view->setLayout('edit')->render();
	}
}
 