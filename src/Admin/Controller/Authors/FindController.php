<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Authors;

use Admin\Model\AuthorsModel;
use Admin\User\UserHelper;
use Windwalker\Application\Web\Response;
use Windwalker\Core\Controller\Controller;
use Windwalker\DataMapper\DataMapper;
use Windwalker\Dom\HtmlElement;
use Windwalker\Ioc;
use Windwalker\Query\QueryElement;

/**
 * The FindController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class FindController extends Controller
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
		$query = $this->input->getString('query');
		$query = trim($query);

		if (!$query)
		{
			return;
		}

		$queries = explode(' ', $query);

		$mapper = new DataMapper('users');

		$conditions = [];
		$q = Ioc::getDatabase()->getQuery(true);

		foreach ($queries as $query)
		{
			if (!trim($query))
			{
				continue;
			}

			$query = $q->quote('%' . $query . '%');

			$conditions[] = 'username LIKE ' . $query;
			$conditions[] = 'fullname LIKE ' . $query;
			$conditions[] = 'email LIKE ' . $query;
		}

		$conditions = new QueryElement('()', $conditions, ' OR ');

		$users = $mapper->find([(string) $conditions], 'username', 0, 10);

		$suggestions = [];

		$tmpl = <<<VALUE
<div>
	<img width="48" height="48" class="find-author-avatar pull-left" src="%s" alt=""/>
	<div class="find-author-name">%s <small>%s</small></div>
	<small>%s</small>
	<div class="clearfix"></div>
</div>
VALUE;

		foreach ($users as $user)
		{
			$suggestions[] = [
				'value' => sprintf($tmpl, UserHelper::getAvatar($user->id), $user->fullname, $user->username, $user->email),
				'data'  => $user->username
			];
		}

		$response = new Response;
		$response->setBody(json_encode(['suggestions' => $suggestions]));
		$response->setMimeType('text/json');

		$response->respond();

		exit();

		return true;
	}
}
