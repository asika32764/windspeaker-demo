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
class UserSeeder extends AbstractSeeder
{
	/**
	 * doExecute
	 *
	 * @return  void
	 */
	public function doExecute()
	{
		$faker = \Faker\Factory::create();

		$password = new \Windwalker\Crypt\Password;
		$pass = $password->create('1234');
		$userMapper = new DataMapper('users');

		foreach (range(1, 100) as $row)
		{
			$data['username'] = $row == 1 ? 'asika' : $faker->userName;
			$data['fullname'] = $row == 1 ? 'Simon Asika' : $faker->name;
			$data['email'] = $faker->email;
			$data['password'] = $pass;
			$data['description'] = $faker->text();
			$data['image'] = 'http://cl.ly/Yapj/397512_301002056764411_3688152576777782947_n.jpg';
			$data['website'] = $faker->url;
			$data['state'] = $faker->numberBetween(-1, 1);
			$data['timezone'] = $faker->timezone;
			$data['language'] = $faker->languageCode;
			$data['activation'] = md5(uniqid());
			$data['register_date'] = $faker->date;
			$data['last_visit_date'] = $faker->date;
			$data['params'] = '';

			$userMapper->createOne($data);
		}

		$this->command->out('User Seeder executed.')->out();
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
 