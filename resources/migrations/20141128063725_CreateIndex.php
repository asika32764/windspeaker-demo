<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Database\Schema\Key;

/**
 * Migration class, version: 20141128063725
 */
class CreateIndex extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->db->getTable('posts')
			->addIndex(Key::TYPE_INDEX, 'blog', 'blog')
			->addIndex(Key::TYPE_INDEX, 'type', 'type')
			->addIndex(Key::TYPE_INDEX, 'alias', 'alias')
			->addIndex(Key::TYPE_INDEX, 'state', 'state')
			->addIndex(Key::TYPE_INDEX, 'author', 'author')
			->update();

		$this->db->getTable('authors')
			->addIndex(Key::TYPE_INDEX, 'user', 'user')
			->addIndex(Key::TYPE_INDEX, 'blog', 'blog')
			->addIndex(Key::TYPE_INDEX, 'admin', 'admin')
			->addIndex(Key::TYPE_INDEX, 'owner', 'owner')
			->update();

		$this->db->getTable('categories')
			->addIndex(Key::TYPE_INDEX, 'blog', 'blog')
			->addIndex(Key::TYPE_INDEX, 'alias', 'alias')
			->addIndex(Key::TYPE_INDEX, 'state', 'state')
			->addIndex(Key::TYPE_INDEX, 'ordering', 'ordering')
			->update();

		$this->db->getTable('category_post_maps')
			->addIndex(Key::TYPE_INDEX, 'category', 'category')
			->addIndex(Key::TYPE_INDEX, 'post', 'post')
			->update();

		$this->db->getTable('blogs')
			->addIndex(Key::TYPE_INDEX, 'owner', 'owner')
			->addIndex(Key::TYPE_INDEX, 'alias', 'alias')
			->addIndex(Key::TYPE_INDEX, 'state', 'state')
			->update();

		$this->db->getTable('users')
			->addIndex(Key::TYPE_INDEX, 'username', 'username')
			->addIndex(Key::TYPE_INDEX, 'email', 'email')
			->addIndex(Key::TYPE_INDEX, 'state', 'state')
			->addIndex(Key::TYPE_INDEX, 'timezone', 'timezone')
			->addIndex(Key::TYPE_INDEX, 'language', 'language')
			->update();
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->db->getTable('posts')
			->dropIndex(Key::TYPE_INDEX, 'blog')
			->dropIndex(Key::TYPE_INDEX, 'type')
			->dropIndex(Key::TYPE_INDEX, 'alias')
			->dropIndex(Key::TYPE_INDEX, 'state')
			->dropIndex(Key::TYPE_INDEX, 'author');

		$this->db->getTable('authors')
			->dropIndex(Key::TYPE_INDEX, 'user')
			->dropIndex(Key::TYPE_INDEX, 'blog')
			->dropIndex(Key::TYPE_INDEX, 'admin')
			->dropIndex(Key::TYPE_INDEX, 'owner');

		$this->db->getTable('categories')
			->dropIndex(Key::TYPE_INDEX, 'blog')
			->dropIndex(Key::TYPE_INDEX, 'alias')
			->dropIndex(Key::TYPE_INDEX, 'state')
			->dropIndex(Key::TYPE_INDEX, 'ordering');

		$this->db->getTable('category_post_maps')
			->dropIndex(Key::TYPE_INDEX, 'category')
			->dropIndex(Key::TYPE_INDEX, 'post');

		$this->db->getTable('blogs')
			->dropIndex(Key::TYPE_INDEX, 'owner')
			->dropIndex(Key::TYPE_INDEX, 'alias')
			->dropIndex(Key::TYPE_INDEX, 'state');

		$this->db->getTable('users')
			->dropIndex(Key::TYPE_INDEX, 'username')
			->dropIndex(Key::TYPE_INDEX, 'email')
			->dropIndex(Key::TYPE_INDEX, 'state')
			->dropIndex(Key::TYPE_INDEX, 'timezone')
			->dropIndex(Key::TYPE_INDEX, 'language');
	}
}
