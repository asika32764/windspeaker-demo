<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Categories;

use Admin\Blog\Blog;
use Admin\Controller\AbstractAdminController;
use Admin\Model\CategoriesModel;
use Admin\View\Categories\CategoriesHtmlView;

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
		$model = new CategoriesModel;
		$view = new CategoriesHtmlView($this->data);

		$model['blog.id']     = Blog::get()->id;
		$model['list.start']  = $this->input->getInt('start');
		$model['list.limit']  = 10;
		$model['list.search'] = $this->input->getString('q');

		$cats = $model->getItems();

		$view['items'] = $cats;

		return $view->render();
	}
}
 