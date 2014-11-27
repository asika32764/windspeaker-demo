<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Post;

use Admin\Author\Author;
use Admin\Blog\Blog;
use Admin\Model\PostModel;
use Joomla\Date\Date;
use Windwalker\Application\Web\Response;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Filter\InputFilter;

/**
 * The SaveController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends Controller
{
	/**
	 * Property quiet.
	 *
	 * @var  bool
	 */
	protected $quiet = false;

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
		$model = new PostModel;

		$data = $this->input->getVar('post');
		$data['text'] = $this->input->getByPath('post.text', null, InputFilter::RAW);

		$data = new Data($data);

		$isNew = !$data['id'];

		try
		{
			$model->validate($data);

			if (!$isNew)
			{
				$oldData = (new DataMapper('posts'))->findOne($data['id']);

				$oldData->bind($data);

				$data = $oldData;

				$data->modified = (new Date)->format('Y-m-d H:i:s');
			}
			else
			{
				$data->blog = Blog::get()->id;

				$data->type = $this->input->get('type', 'post');
				$data->type = $data->type == 'post' ? $data->type : 'static';

				$data->created = (new Date)->format('Y-m-d H:i:s');
			}

			$data->author = $data->author ? : Author::get(User::get()->id, Blog::get()->id)->id;

			$text = preg_split('/(\<\!--\s*\{READMORE\}\s*--\>)/', $data['text'], 2);
			$data->introtext = isset($text[0]) ? $text[0] : null;
			$data->fulltext  = isset($text[1]) ? $text[1] : null;

			$data = $model->save($data);
		}
		catch (ValidFailException $e)
		{
			$return['msg']     = $e->getMessage();
			$return['success'] = false;

			$this->respond($return, 500);

			return false;
		}
		catch (\Exception $e)
		{
			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$return['msg']     = 'Save fail';
			$return['success'] = false;

			$this->respond($return, 500);

			return false;
		}

		$return['msg'] = 'Save success';
		$return['success'] = true;
		$return['item'] = $data;

		$this->respond($return, 200);

		return true;
	}

	/**
	 * respond
	 *
	 * @param array $data
	 * @param int   $code
	 *
	 * @return  void
	 */
	protected function respond($data, $code = 200)
	{
		if ($this->quiet)
		{
			return;
		}

		$response = new Response;
		$response->setBody(json_encode($data));
		$response->setMimeType('application/json');
		$response->setHeader('Status', $code);

		$response->respond();

		exit();

		return;
	}

	/**
	 * Method to set property quiet
	 *
	 * @param   boolean $quiet
	 *
	 * @return  static  Return self to support chaining.
	 */
	public function quiet($quiet)
	{
		$this->quiet = $quiet;

		return $this;
	}
}
 