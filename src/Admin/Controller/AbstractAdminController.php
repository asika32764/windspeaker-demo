<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller;

use Admin\Blog\Blog;
use Admin\Controller\Widget\SidebarController;
use Admin\Model\BlogModel;
use Admin\Model\BlogsModel;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Data\Data;
use Windwalker\Ioc;

/**
 * The AbstractAdminController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class AbstractAdminController extends Controller
{
	/**
	 * Property data.
	 *
	 * @var array
	 */
	protected $data = array();

	/**
	 * Property blog.
	 *
	 * @var  Data
	 */
	protected $blog = null;

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

		$model['user.id'] = User::get()->id;

		$data['activeMenu'] = $this->input->get('activeMenu', 'dashboard');
		$data['hideMenu'] = $this->input->get('hideMenu', 0);
		$data['widget'] = new Data;
		// $data['widget']['sidebar'] = (new SidebarController($this->input, $this->app))->execute();

		$data['blog'] = Blog::get();
		$data['blogs'] = $model->getItems();

		$data['profiler'] = WINDWALKER_DEBUG ? Ioc::getProfiler() : null;

		$this->data = $data;

		return $this->doExecute();
	}

	abstract protected function doExecute();
}
