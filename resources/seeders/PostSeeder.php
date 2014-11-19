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
class PostSeeder extends AbstractSeeder
{
	/**
	 * doExecute
	 *
	 * @return  void
	 */
	public function doExecute()
	{
		$faker = \Faker\Factory::create();

		$blogMapper      = new DataMapper('blogs');
		$categoryMapper  = new DataMapper('categories');
		$authorMapper    = new DataMapper('authors');
		$postMapper      = new DataMapper('posts');
		$psMappingMapper = new DataMapper('category_post_maps');

		$content = file_get_contents(__DIR__ . '/fixtures/testcase.md');
		list($introtext, $fulltext) = explode('<!-- {READMORE} -->', $content);

		$metadesc = $faker->text();

		foreach ($blogMapper->findAll() as $blog)
		{
			$authors = iterator_to_array($authorMapper->find(['blog' => $blog->id]));
			$categories = iterator_to_array($categoryMapper->find(['blog' => $blog->id]));

			// Post
			foreach (range(1, 30) as $row)
			{
				$data = array();

				$data['blog'] = $blog->id;
				$data['type'] = 'post';
				$data['title'] = $faker->sentence(rand(3, 8));
				$data['alias'] = \Windwalker\Filter\OutputFilter::stringURLSafe($data['title']);
				$data['introtext'] = $introtext;
				$data['fulltext'] = $fulltext;
				$data['metadesc'] = $metadesc;
				$data['state'] = 1;
				$data['created'] = $faker->dateTime->format('Y-m-d H:i:s');
				$data['modified'] = $faker->dateTime->format('Y-m-d H:i:s');
				$data['publish_up'] = '';
				$data['publish_down'] = '';
				$data['author'] = $faker->randomElement($authors)->id;

				$data = $postMapper->createOne($data);

				// Categories
				foreach ($faker->randomElements($categories, rand(1, 3)) as $category)
				{
					$map['category'] = $category->id;
					$map['post'] = $data['id'];

					$psMappingMapper->createOne($map);
				}
			}

			// Static
			foreach (range(1, 3) as $row)
			{
				$data = array();

				$data['blog'] = $blog->id;
				$data['type'] = 'static';
				$data['title'] = $faker->sentence(rand(3, 8));
				$data['alias'] = \Windwalker\Filter\OutputFilter::stringURLSafe($data['title']);
				$data['introtext'] = $introtext;
				$data['fulltext'] = $fulltext;
				$data['metadesc'] = $metadesc;
				$data['state'] = 1;
				$data['created'] = $faker->dateTime->format('Y-m-d H:i:s');
				$data['modified'] = $faker->dateTime->format('Y-m-d H:i:s');
				$data['publish_up'] = '';
				$data['publish_down'] = '';
				$data['author'] = $faker->randomElement($authors)->id;

				$data = $postMapper->createOne($data);
			}
		}

		$this->command->out('Post Seeder executed.')->out();
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
 