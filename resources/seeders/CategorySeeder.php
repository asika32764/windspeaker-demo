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
class CategorySeeder extends AbstractSeeder
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
		$categoryMapper = new DataMapper('categories');

		foreach ($blogMapper->findAll() as $blog)
		{
			foreach (range(1, rand(3, 6)) as $row)
			{
				$data = array();

				$data['blog'] = $blog->id;
				$data['title'] = $faker->sentence(rand(3, 8));
				$data['alias'] = \Windwalker\Filter\OutputFilter::stringURLSafe($data['title']);
				$data['image'] = 'http://unsplash.it/300/200';
				$data['state'] = 1;
				$data['ordering'] = $row;

				$categoryMapper->createOne($data);
			}
		}

		$this->command->out('Category Seeder executed.')->out();
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
 