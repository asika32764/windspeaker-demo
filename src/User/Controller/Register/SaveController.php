<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Controller\Register;

use Admin\Model\BlogModel;
use Joomla\Date\Date;
use Windwalker\Core\Authenticate\User;
use Windwalker\Core\Controller\Controller;
use Windwalker\Core\Model\Exception\ValidFailException;
use Windwalker\Core\Router\Router;
use User\Model\RegistrationModel;
use Windwalker\Data\Data;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Filter\OutputFilter;
use Windwalker\Ioc;
use Windwalker\String\Utf8String;
use Windwalker\Validator\Rule\EmailValidator;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class SaveController extends Controller
{
	/**
	 * Execute the controller.
	 *
	 * @throws \Exception
	 * @return  mixed Return executed result.
	 */
	public function execute()
	{

		$user    = $this->input->getVar('registration');
		$user    = new Data($user);
		$session = Ioc::getSession();

		$session['register.form.data'] = $user;

		$trans = Ioc::getDatabase()->getTransaction()->start();

		try
		{
			$this->validate($user);

			// User
			$user = $this->createUser($user);

			// Blog
			$blogCtrl = $this->createBlog($user);

			// Articles
			$this->createDefaultArticle($blogCtrl);
		}
		catch (ValidFailException $e)
		{
			$trans->rollback();

			$this->setRedirect(Router::buildHttp('user:registration'), $e->getMessage(), 'danger');

			return false;
		}
		catch (\Exception $e)
		{
			$trans->rollback();

			if (WINDWALKER_DEBUG)
			{
				throw $e;
			}

			$this->setRedirect(Router::buildHttp('user:registration'), 'Register fail', 'danger');

			return false;
		}

		$trans->commit();

		$session->remove('register.form.data');

		// OK let's login
		User::makeUserLogin($user->id);

		$this->setRedirect(Router::buildHttp('user:login'), 'Register success.', 'success');

		return true;
	}

	/**
	 * createUser
	 *
	 * @param Data $user
	 *
	 * @throws  ValidFailException
	 * @return  Data
	 */
	protected function createUser(Data $user)
	{
		$model   = new RegistrationModel;

		// Check exists
		$oldUser = (new DataMapper('users'))->findOne(['username' => $user->username]);

		if ($oldUser->notNull())
		{
			throw new ValidFailException('Username has exists.');
		}

		$oldUser = (new DataMapper('users'))->findOne(['email' => $user->email]);

		if ($oldUser->notNull())
		{
			throw new ValidFailException('Email has been used.');
		}

		$user->fullname      = $user->username;
		$user->register_date = (new Date)->format('Y-m-d H:i:s', true);
		$user->language      = 'en-GB';
		$user->timezone      = 'UTC';
		$user->state         = 1;
		$user->activation    = md5(uniqid() . $user->username);

		return $model->register($user);
	}

	/**
	 * createBlog
	 *
	 * @param Data $user
	 *
	 * @return  \Admin\Controller\Blog\SaveController
	 *
	 * @throws \Exception
	 */
	protected function createBlog(Data $user)
	{
		$blog['owner'] = $user->id;
		$blog['title'] = $user->fullname . "'s Blog";
		$blog['alias'] = $this->createBlogAlias($user->username);
		$blog['state'] = 1;
		$blog['timezone'] = 'UTC';

		$this->input->set('blog', $blog);
		$this->input->set('user_id', $user->id);

		$blogCtrl = new \Admin\Controller\Blog\SaveController($this->input, $this->app);

		try
		{
			$blogCtrl->execute();
		}
		catch (\OutOfRangeException $e)
		{
			// Nothing have to do...
		}

		return $blogCtrl;
	}

	/**
	 * createDefaultArticle
	 *
	 * @param \Admin\Controller\Blog\SaveController $blogCtrl
	 *
	 * @return  void
	 */
	protected function createDefaultArticle(\Admin\Controller\Blog\SaveController $blogCtrl)
	{
		$blog = $blogCtrl->getBlog();
		$author = $blogCtrl->getAuthor();
		$postMapper = new DataMapper('posts');

		$content = file_get_contents(__DIR__ . '/../../Resources/post/hello.md');
		list($intro, $full) = explode('<!-- {READMORE} -->', $content);

		$post['blog'] = $blog->id;
		$post['author'] = $author->id;
		$post['type'] = 'post';
		$post['title'] = 'Hello World';
		$post['alias'] = 'hello-world';
		$post['introtext'] = $intro;
		$post['fulltext'] = $full;
		$post['state'] = 1;
		$post['created'] = (new Date)->format('Y-m-d H:i:s');

		$postMapper->createOne($post);

		$post['blog'] = $blog->id;
		$post['author'] = $author->id;
		$post['type'] = 'static';
		$post['title'] = 'About Me';
		$post['alias'] = 'about-me';
		$post['introtext'] = 'Hello I\'m ' . $author->name . '. Welcome to my blog.';
		$post['state'] = 1;
		$post['created'] = (new Date)->format('Y-m-d H:i:s');

		$postMapper->createOne($post);
	}

	/**
	 * validate
	 *
	 * @param Data $data
	 *
	 * @return  void
	 *
	 * @throws ValidFailException
	 */
	protected function validate($data)
	{
		if (!$data->tos)
		{
			// throw new ValidFailException('You must agree terms and policy');
		}

		if (!$data->username)
		{
			throw new ValidFailException('Username empty');
		}

		if (!(new EmailValidator())->validate($data->email))
		{
			throw new ValidFailException('Email not valid.');
		}

		if (!$data->password)
		{
			throw new ValidFailException('Password empty');
		}

		if (Utf8String::strlen($data->password) < 4)
		{
			throw new ValidFailException('Password should longer than 4 characters.');
		}

		if ($data->password != $data->password2)
		{
			throw new ValidFailException('Password not match.');
		}
	}

	/**
	 * createBlogAlias
	 *
	 * @param string $username
	 *
	 * @return  string
	 */
	protected function createBlogAlias($username)
	{
		$username = strtolower($username);

		$alias = OutputFilter::stringURLSafe($username);

		$blogMapper = new DataMapper('blogs');

		if ($blogMapper->findOne(['alias' => $alias])->notNull())
		{
			$alias = $alias . '-blog';
		}

		while ($blogMapper->findOne(['alias' => $alias])->notNull())
		{
			$alias = 'u' . rand(100000, 9999999999);
		}

		return $alias;
	}

	/**
	 * getDefaultCss
	 *
	 * @return  string
	 */
	protected function getDefaultCss()
	{
		return <<<CSS
/* Homepage banner */
.home #banner {
    background-image: url(http://windspeaker.s3.amazonaws.com/banners/city.jpg);
}

/* Post page banner */
.post #banner,
.static #banner {
    background-image: url(http://windspeaker.s3.amazonaws.com/banners/city.jpg);
    background-position: center -490px;
}

CSS;
	}
}
 