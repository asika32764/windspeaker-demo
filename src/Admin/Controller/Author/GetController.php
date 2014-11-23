<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Author;

use Admin\Controller\AbstractAdminController;
use Admin\Model\AuthorModel;
use Admin\View\Author\AuthorHtmlView;
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
	 * @return  string
	 */
	protected function doExecute()
	{
		$id = $this->input->get('id');

		$author = $id ? (new DataMapper('authors'))->findOne($id) : new Data;

		$model = new AuthorModel;

		$view = new AuthorHtmlView($this->data);

		$view['form'] = $model->getForm($author);
		$view['item'] = $author;

		return $view->setLayout('edit')->render();
	}
}
 