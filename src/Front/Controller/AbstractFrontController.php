<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Controller;

use Admin\Author\Author;
use Front\Model\PostsModel;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Ioc;
use Windwalker\Registry\Registry;

/**
 * The AbstractFrontController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
abstract class AbstractFrontController extends Controller
{
	/**
	 * Property data.
	 *
	 * @var Data
	 */
	protected $data;

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
		$model = new PostsModel;

		$blog   = Ioc::get('current.blog', 'front');
		$author = (new DataMapper('authors'))->findOne(['blog' => $blog->id, 'owner' => 1]);
		$user   = (new DataMapper('users'))->findOne(['id' => $author->user]);

		$this->data['blog']        = $blog;
		$this->data['ownerUser']   = $user;
		$this->data['ownerAuthor'] = $author;
		$this->data['user']        = User::get();
		$this->data['author']      = Author::get($user->id, $blog->id);

		// Statics
		$model['blog.id']        = $blog->id;
		$model['list.start']     = null;
		$model['list.limit']     = null;
		$model['blog.published'] = true;
		$model['post.type']      = 'static';
		$model['post.ordering']  = 'id asc';

		$this->data['statics'] = $model->getItems();
		$this->data['blog']->link = 'http://' . $this->data['blog']->alias . '.windspeaker.co';
		$this->data['blog']->params = new Registry($this->data['blog']->params);
		$this->data['meta'] = new Data;

		return $this->doExecute();
	}

	abstract protected function doExecute();
}
