<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Author;

use Admin\Author\Author;
use Admin\User\UserHelper;
use Windwalker\Application\Web\Response;
use Windwalker\Core\Controller\Controller;
use Windwalker\DataMapper\DataMapper;
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
		try
		{
			$id = $this->input->get('id');

			if ($id)
			{
				$author = Author::getAuthor($id);

				$author->image = "0";

				(new DataMapper('authors'))->updateOne($author, 'id');
			}
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
		$return['image']   = UserHelper::getGavatar('fake@fake.com', 400);

		$response = new Response;
		$response->setBody((string) $return);
		$response->setMimeType('text/json');

		$response->respond();

		exit();
	}
}
