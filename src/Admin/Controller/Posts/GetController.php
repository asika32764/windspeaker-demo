<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Posts;

use Admin\Controller\AbstractAdminController;
use Admin\Model\PostsModel;
use Admin\View\Posts\PostsHtmlView;

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
		$type = $this->input->get('type', 'post');

		$view = new PostsHtmlView($this->data);

		$model = new PostsModel;

		$model['blog.id']     = $this->data['blog']->id;
		$model['blog.type']   = $type;
		$model['list.start']  = $this->input->getInt('start');
		$model['list.limit']  = 10;
		$model['list.search'] = $this->input->getString('q');

		$view->set('items', $model->getItems());
		$view->set('type', $type);

		return $view->render();
	}
}
 