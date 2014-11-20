<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Authors;

use Admin\Controller\AbstractAdminController;
use Admin\Model\AuthorsModel;
use Admin\View\Authors\AuthorsHtmlView;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends AbstractAdminController
{
	protected function doExecute()
	{
		$view = new AuthorsHtmlView($this->data);

		$model = new AuthorsModel;

		$model['blog.id']     = $this->data['blog']->id;
		$model['list.start']  = $this->input->getInt('start');
		$model['list.limit']  = 10;
		$model['list.search'] = $this->input->getString('q');

		$view->set('items', $model->getItems());

		return $view->render();
	}
}
 