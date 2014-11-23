<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Blogs;

use Admin\Blog\Blog;
use Admin\Controller\AbstractAdminController;
use Admin\Model\BlogsModel;
use Admin\View\Blogs\BlogsHtmlView;
use Windwalker\Core\Authenticate\User;

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
	 * @return  boolean
	 */
	protected function doExecute()
	{
		$model = new BlogsModel;
		$view = new BlogsHtmlView($this->data);

		$model['user.id']     = User::get()->id;
		// $model['list.start']  = $this->input->getInt('start');
		$model['list.limit']  = 100;
		$model['list.search'] = $this->input->getString('q');

		$cats = $model->getItems();

		$view['items'] = $cats;

		return $view->render();
	}
}
 