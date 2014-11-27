<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\View\Profile;

use Admin\User\UserHelper;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\View\BladeHtmlView;

/**
 * The ProfileHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ProfileHtmlView extends BladeHtmlView
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
		$data['avatar'] = UserHelper::getAvatar(User::get()->id, 650);
	}
}
