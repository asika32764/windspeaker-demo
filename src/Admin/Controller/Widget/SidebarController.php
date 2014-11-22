<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Widget;

use Admin\Blog\Blog;
use Admin\Model\BlogsModel;
use Admin\View\Widget\WidgetHtmlView;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;

/**
 * The SidebarController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SidebarController extends Controller
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
		$model = new BlogsModel;
		$view = new WidgetHtmlView;

		$model['user.id'] = User::get()->id;

		$view['blog'] = Blog::get();;
		$view['blogs'] = $model->getItems();
		$view['activeMenu'] = $this->input->get('activeMenu', 'dashboard');

		return $view->setLayout('sidebar')->render();
	}
}
 