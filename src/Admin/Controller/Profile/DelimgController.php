<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Profile;

use Admin\S3\S3Helper;
use Admin\User\UserHelper;
use Windwalker\Application\Web\Response;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Filter\InputFilter;
use Windwalker\Registry\Registry;

/**
 * The ImageController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DelimgController extends Controller
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
		$user = User::get();

		try
		{
			$user->image = "0";

			User::save($user);
		}
		catch (\Exception $e)
		{
			$response = new Response;
			$response->setBody(json_encode(['error' => $e->getMessage()]));
			$response->setMimeType('text/json');

			$response->respond();

			exit();
		}

		$return = new Registry;

		$return['success'] = true;
		$return['image'] = UserHelper::getAvatar($user->id, 650);

		$response = new Response;
		$response->setBody((string) $return);
		$response->setMimeType('text/json');

		$response->respond();

		exit();
	}
}
