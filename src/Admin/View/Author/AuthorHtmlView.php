<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\View\Author;

use Admin\Author\Author;
use Windwalker\Core\View\BladeHtmlView;

/**
 * The AuthorHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AuthorHtmlView extends BladeHtmlView
{
	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
		$data['avatar'] = Author::getAvatar($data['item']->id ? : -1, 650);
	}
}
 