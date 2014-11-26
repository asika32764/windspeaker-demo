<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Controller\Posts;

use Admin\Author\Author;
use Front\Controller\AbstractFrontController;
use Front\Model\PostsModel;
use Front\View\Posts\PostsHtmlView;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Ioc;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends AbstractFrontController
{
	/**
	 * Execute the controller.
	 *
	 * @return  mixed Return executed result.
	 *
	 * @throws  \LogicException
	 * @throws  \RuntimeException
	 */
	public function doExecute()
	{
		$model = new PostsModel;
		$view  = new PostsHtmlView($this->data);

		$model['blog.id']        = $view['blog']->id;
		$model['blog.published'] = $view['user']->isNull();
		$model['list.page']      = $this->input->getInt('page', 1);
		$model['list.limit']     = 10;
		$model['list.start']     = ($model['list.page'] - 1) * $model['list.limit'];

		$view['posts'] = $model->getItems();
		$view['pagination'] = $model->getPagination()->build();

		return $view->render();
	}
}
 