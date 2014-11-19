<?php
/**
 * Part of softvilla project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Seeder\AbstractSeeder;

/**
 * The DatabaseSeeder class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class DatabaseSeeder extends AbstractSeeder
{
	/**
	 * doExecute
	 *
	 * @return  void
	 */
	public function doExecute()
	{
		$this->execute('UserSeeder');
		$this->execute('BlogSeeder');
		$this->execute('AuthorSeeder');
		$this->execute('CategorySeeder');
		$this->execute('PostSeeder');

		$this->command->out('All Seeder executed.')->out();
	}

	/**
	 * doClean
	 *
	 * @return  void
	 */
	public function doClean()
	{
		$this->db->getTable('users')->truncate();
		$this->db->getTable('blogs')->truncate();
		$this->db->getTable('authors')->truncate();
		$this->db->getTable('categories')->truncate();
		$this->db->getTable('category_post_maps')->truncate();
		$this->db->getTable('posts')->truncate();

		$this->command->out('Database clean.')->out();
	}
}
 