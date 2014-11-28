<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Author;

use Admin\Author\Author;
use Admin\Blog\Blog;
use Admin\S3\S3Helper;
use Windspeaker\Image\Thumb;
use Windwalker\Application\Web\Response;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Filesystem\File;
use Windwalker\Filter\InputFilter;
use Windwalker\Registry\Registry;
use Windwalker\UUID\Uuid;

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
		$files  = $this->input->files;
		$field  = $this->input->get('field', 'file');
		$id     = $this->input->get('id');
		$author = Author::getAuthor($id);
		$user   = User::get();
		$blog   = Blog::get();

		try
		{
			if (!Author::isAdmin($blog, $user))
			{
				throw new ValidFailException('You cannot edit this author.');
			}

			$src  = $files->getByPath($field . '.tmp_name', null, InputFilter::STRING);
			$name = $files->getByPath($field . '.name', null, InputFilter::STRING);

			if (!$src)
			{
				throw new \Exception('File not upload');
			}

			$ext = pathinfo($name, PATHINFO_EXTENSION);

			$uuid = $author->uuid ? : Uuid::v4();

			$src  = Thumb::createThumb($src);
			$dest = sprintf('author/%s/%s.%s', sha1($uuid), md5($uuid), $ext);

			$result = S3Helper::put($src, $dest);

			File::delete($src);

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
		$return['uuid'] = $uuid;

		if ($author->id)
		{
			$author->image = $return['filename'];

			(new DataMapper('authors'))->updateOne($author);
		}

		$response = new Response;
		$response->setBody((string) $return);
		$response->setMimeType('text/json');

		$response->respond();

		exit();
	}
}
