<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Profile;

use Admin\S3\S3Helper;
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
class ImageController extends Controller
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
		$files = $this->input->files;
		$field = $this->input->get('field', 'file');
		$user = User::get();

		try
		{
			$src  = $files->getByPath($field . '.tmp_name', null, InputFilter::STRING);
			$name = $files->getByPath($field . '.name', null, InputFilter::STRING);

			if (!$src)
			{
				throw new \Exception('File not upload');
			}

			$ext = pathinfo($name, PATHINFO_EXTENSION);

			$dest = sprintf('user/%s/%s.%s', sha1('user-profile-' . $user->id), md5('user-profile-' . $user->id), $ext);

			$result = S3Helper::put($src, $dest);

			if (!$result)
			{
				throw new \Exception('Upload fail.');
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

		$return['filename'] = 'https://windspeaker.s3.amazonaws.com/' . $dest;
		$return['file'] = 'https://windspeaker.s3.amazonaws.com/' . $dest;

		$user->image = $return['filename'];

		User::save($user);

		$response = new Response;
		$response->setBody((string) $return);
		$response->setMimeType('text/json');

		$response->respond();

		exit();
	}
}
