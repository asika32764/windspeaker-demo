<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\Controller;

use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Ioc;

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
		$blog   = Ioc::get('current.blog', 'front');
		$author = (new DataMapper('authors'))->findOne(['blog' => $blog->id, 'owner' => 1]);
		$user   = (new DataMapper('users'))->findOne(['id' => $author->user]);

		$this->data['blog']        = $blog;
		$this->data['ownerUser']   = $user;
		$this->data['ownerAuthor'] = $author;
		$this->data['user']        = User::get();
		$this->data['author'] = $this->data['user'] ? (new DataMapper('authors'))->findOne(['user' => $this->data['user']->id]) : new Data;

		return $this->doExecute();
	}

	abstract protected function doExecute();
}
