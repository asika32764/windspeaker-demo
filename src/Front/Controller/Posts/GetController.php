<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Controller\Posts;

use Admin\Author\Author;
use Front\Model\PostsModel;
use Front\View\Posts\PostsHtmlView;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Ioc;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends Controller
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
		$blog = Ioc::get('current.blog', 'front');
		$author = (new DataMapper('authors'))->findOne(['blog' => $blog->id, 'owner' => 1]);
		$user = (new DataMapper('users'))->findOne(['id' => $author->user]);

		$currentUser = User::get();
		$currentAuthor = (new DataMapper('authors'))->findOne(['user' => $currentUser->id]);

		$model = new PostsModel;
		$view = new PostsHtmlView;

		$model['blog.id'] = $blog->id;
		$model['blog.published'] = $currentAuthor->isNull();
		$model['list.start'] = $this->input->getInt('start');
		$model['list.limit'] = 10;

		$view['posts'] = $model->getItems();

		$model['list.start'] = null;
		$model['list.limit'] = null;
		$model['blog.published'] = true;
		$model['post.type'] = 'static';

		$view['statics'] = $model->getItems();

		$view['ownerUser']   = $user;
		$view['ownerAuthor'] = $author;
		$view['user']   = $currentUser;
		$view['author'] = $currentAuthor;
		$view['blog'] = $blog;

		return $view->render();
	}
}
 