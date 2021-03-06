<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Post;

use Admin\Controller\AbstractAdminController;
use Admin\Model\PostModel;
use Admin\View\Post\PostHtmlView;

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
		$type = $type == 'post' ? $type : 'static';

		$view = new PostHtmlView($this->data);
		$model = new PostModel;

		$model['post.type'] = $type;

		$id = $this->input->get('id');

		$view['item'] = $model->getItem($id);
		$view['type'] = $type;
		$view['form'] = $model->getForm($view['item']);

		return $view->setLayout('edit')->render();
	}
}
