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
use Front\View\Posts\PostsFeedView;
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
		$format = $this->input->get('format', 'html');

		$model = new PostsModel;

		if ($format == 'feed')
		{
			$this->app->response->setMimeType('application/rss+xml');
			$view  = new PostsFeedView($this->data);
			$limit = 50;
		}
		else
		{
			$view  = new PostsHtmlView($this->data);
			$limit = 10;
		}

		$model['blog.id']        = $view['blog']->id;
		$model['blog.published'] = $view['user']->isNull();
		$model['list.page']      = $page = $this->input->getInt('page', 1);
		$model['list.limit']     = $limit;
		$model['list.start']     = ($model['list.page'] - 1) * $model['list.limit'];
		$model['list.ordering']  = 'id desc';

		$view['posts']      = $model->getItems();
		$view['pagination'] = $model->getPagination()->build();
		$view['page']       = $page;
		$view['type']       = $this->input->get('type', 'home');

		return $view->render();
	}
}
 