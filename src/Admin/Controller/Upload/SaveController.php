<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Upload;

use Joomla\Date\Date;
use Windwalker\Application\Web\Response;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Filesystem\File;
use Windwalker\Filesystem\Folder;
use Windwalker\Filter\InputFilter;
use Windwalker\Registry\Registry;
use Windwalker\UUID\Uuid;

/**
 * The SaveController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends Controller
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
		$type  = $this->input->get('type', 'post');

		try
		{
			$src  = $files->getByPath($field . '.tmp_name', null, InputFilter::STRING);
			$name = $files->getByPath($field . '.name', null, InputFilter::STRING);

			if (!$src)
			{
				throw new \Exception('File not upload');
			}

			$dest = $this->getDest($name, $type);

			$s3 = new \S3(
				$this->app->get('amazon.access_key'),
				$this->app->get('amazon.secret_key')
			);


			$result = $s3::putObject(\S3::inputFile($src, false), 'windspeaker', $dest, \S3::ACL_PUBLIC_READ);

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

		$response = new Response;
		$response->setBody((string) $return);
		$response->setMimeType('text/json');

		$response->respond();

		exit();
	}

	/**
	 * getDest
	 *
	 * @param string $name
	 * @param string $type
	 *
	 * @return  string
	 */
	protected function getDest($name, $type = 'post')
	{
		$user = User::get();

		$date = new Date;

		$year  = $date->year;
		$month = $date->month;
		$day   = $date->day;

		$ext = pathinfo($name, PATHINFO_EXTENSION);

		switch ($type)
		{
			case 'post':
				return sprintf('post/%s/%s/%s/%s/%s.%s', $user->username, $year, $month, $day, uniqid(), $ext);
				break;
			case 'profile':
				return sprintf('user/%s/%s.%s', sha1('user-profile-' . $user->id), md5('user-profile-' . $user->id), $ext);
			default:
				return sprintf('images/%s/%s/%s/%s/%s.%s', $user->username, $year, $month, $day, uniqid(), $ext);
		}
	}
}
 