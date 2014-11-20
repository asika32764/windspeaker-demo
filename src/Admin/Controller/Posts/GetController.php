<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Posts;

use Admin\Model\BlogModel;
use Admin\Model\PostsModel;
use Admin\View\Posts\PostsHtmlView;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\View\BladeHtmlView;
use Windwalker\Data\Data;
use Windwalker\Ioc;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends Controller
{
	/**
	 * Execute the controller.
	 *
	 * @return  mixed Return executed result.
	 *
	 * @throws  \LogicException
	 * @throws  \RuntimeException
	 */
	public function execute()
	{
		$view = new PostsHtmlView;

		$model = new PostsModel;
		$blog = $this->getBlog();

		$model['blog.id']     = $blog->id;
		$model['list.start']  = $this->input->getInt('start');
		$model['list.limit']  = 10;
		$model['list.search'] = $this->input->getString('q');

		$view->set('items', $model->getItems());

		return $view->render();
	}

	/**
	 * getBlog
	 *
	 * @return  Data
	 */
	protected function getBlog()
	{
		$session = Ioc::getSession();

		$blogId = $session->get('current.blog');

		$blogModel = new BlogModel;

		$blog = $blogModel->getCurrentBlog(1, $blogId);

		$session->set('current.blog', $blog->id);

		return $blog;
	}
}
 