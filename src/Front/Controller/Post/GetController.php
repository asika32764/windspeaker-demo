<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Controller\Post;

use Admin\Author\Author;
use Front\Controller\AbstractFrontController;
use Front\Model\PostModel;
use Front\View\Post\PostHtmlView;
use Windwalker\Core\Router\Router;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends AbstractFrontController
{
	/**
	 * doExecute
	 *
	 * @return  bool|string
	 *
	 * @throws \Exception
	 */
	protected function doExecute()
	{
		$view  = new PostHtmlView($this->data);
		$model = new PostModel;
		$id    = $this->input->get('id');
		$alias = $this->input->get('alias');

		$view['post'] = $post = $model->getItem($id);
		$view['postAuthor'] = Author::getPostAuthor($post->author);

		if ($post->isNull())
		{
			throw new \Exception('Post not found', 404);
		}

		if ($post->blog != $view['blog']->id)
		{
			throw new \Exception('Post not found', 404);
		}

		if ($alias != $view['post']->alias)
		{
			$get = $this->input->get;

			$get->set('_rawRoute', null);

			$queries = $this->input->get->getArray();

			$queries['alias'] = $view['post']->alias;

			$this->app->redirect(Router::buildHttp('front:post_default', $queries), true);

			return false;
		}

		return $view->render();
	}
}
 