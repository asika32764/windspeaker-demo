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
		$model['post.type']   = $type;
		$model['list.page']   = $page = $this->input->getInt('page', 1);
		$model['list.limit']  = 10;
		$model['list.start']  = ($model['list.page'] - 1) * $model['list.limit'];
		$model['list.search'] = $this->input->getString('q');
		$model['list.ordering'] = 'post.id desc';

		$view->set('items', $model->getItems());
		$view->set('pagination', $model->getPagination()->build());
		$view->set('type', $type);

		return $view->render();
	}
}
 