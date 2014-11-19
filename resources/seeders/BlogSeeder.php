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
class BlogSeeder extends AbstractSeeder
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
		$users = (new DataMapper('users'))->findAll();

		foreach (range(1, 600) as $row)
		{
			$data['owner'] = $users[$faker->numberBetween(1, count($users) - 1)]->id;
			$data['title'] = $faker->sentence(4);
			$data['alias'] = \Windwalker\Filter\OutputFilter::stringURLSafe($data['title']);
			$data['sub_title'] = $faker->sentence(8);
			$data['description'] = $faker->text();
			$data['image'] = 'https://unsplash.it/200/300';
			$data['timezone'] = $faker->timezone;
			$data['disqus'] = 'asukademy';
			$data['webmaster'] = md5(1234);
			$data['analytics'] = 'UA-xxxx-xx-xx';
			$data['params'] = '';

			$blogMapper->createOne($data);
		}

		$this->command->out('Blog Seeder executed.')->out();
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
 