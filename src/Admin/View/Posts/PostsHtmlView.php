<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\View\Posts;

use Admin\Blog\Blog;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\View\BladeHtmlView;

/**
 * The PostsHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PostsHtmlView extends BladeHtmlView
{
	/**
	 * Property name.
	 *
	 * @var  string
	 */
	protected $name = 'posts';

	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
		$data->user = User::get();
		$data->route = $data->type == 'static' ? 'front:static' : 'front:post_default';
	}
}
 