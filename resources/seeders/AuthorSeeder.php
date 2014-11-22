<?php
/**
 * Part of softvilla project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Seeder\AbstractSeeder;
use Windwalker\DataMapper\DataMapper;

/**
 * The DatabaseSeeder class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AuthorSeeder extends AbstractSeeder
{
	/**
	 * doExecute
	 *
	 * @return  void
	 */
	public function doExecute()
	{
		$faker = \Faker\Factory::create();

		$blogMapper = new DataMapper('blogs');
		$authorMapper = new DataMapper('authors');
		$users = (new DataMapper('users'))->findAll();

		foreach ($blogMapper->findAll() as $blog)
		{
			// Is user
			$randUsers = $faker->randomElements(iterator_to_array($users), rand(1, 3));

			$hasOwner = false;

			foreach ($randUsers as $user)
			{
				$data = array();

				$data['user'] = $user->id;
				$data['blog'] = $blog->id;
				$data['admin'] = $hasOwner ? rand(0, 1) : 1;
				$data['owner'] = $hasOwner ? 0 : 1;

				$authorMapper->createOne($data);

				$hasOwner = true;
			}

			// Is Author
			foreach (range(1, rand(1, 3)) as $row)
			{
				$data = array();

				$data['blog'] = $blog->id;
				$data['name'] = $faker->name;
				$data['description'] = $faker->text();
				$data['image'] = 'http://cl.ly/Yapj/397512_301002056764411_3688152576777782947_n.jpg';
				$data['website'] = $faker->url;

				$authorMapper->createOne($data);
			}
		}

		$this->command->out('Author Seeder executed.')->out();
	}

	/**
	 * doClean
	 *
	 * @return  void
	 */
	public function doClean()
	{
		$this->command->out('Database clean.')->out();
	}
}
 