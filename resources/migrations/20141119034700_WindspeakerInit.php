<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Database\Schema\Column\Char;
use Windwalker\Database\Schema\Column\Integer;
use Windwalker\Database\Schema\Column\Primary;
use Windwalker\Database\Schema\Column\Text;
use Windwalker\Database\Schema\Column\Timestamp;
use Windwalker\Database\Schema\Column\Tinyint;
use Windwalker\Database\Schema\Column\Varchar;
use Windwalker\Database\Schema\Key;

/**
 * Migration class, version: 20141119034700
 */
class WindspeakerInit extends AbstractMigration
{
	/**
	 * Migrate Up.
	 */
	public function up()
	{
		$this->db->getTable('posts')
			->addColumn(new Primary('id'))
			->addColumn(new Integer('blog'))
			->addColumn(new Char('type', 8))
			->addColumn(new Varchar('title'))
			->addColumn(new Varchar('alias'))
			->addColumn(new Text('introtext'))
			->addColumn(new Text('fulltext'))
			->addColumn(new Text('metadesc'))
			->addColumn(new Tinyint('state'))
			->addColumn(new Timestamp('created'))
			->addColumn(new Timestamp('modified'))
			->addColumn(new Timestamp('publish_up'))
			->addColumn(new Timestamp('publish_down'))
			->addColumn(new Integer('author'))
			->addColumn(new Varchar('author_alias'))
			->addColumn(new Text('params'))
			->create();

		$this->db->getTable('blogs')
			->addColumn(new Primary('id'))
			->addColumn(new Integer('owner'))
			->addColumn(new Varchar('title'))
			->addColumn(new Varchar('alias'))
			->addColumn(new Varchar('sub_title'))
			->addColumn(new Text('description'))
			->addColumn(new Varchar('image'))
			->addColumn(new Tinyint('state'))
			->addColumn(new Char('timezone', 15))
			->addColumn(new Varchar('disqus'))
			->addColumn(new Varchar('webmaster'))
			->addColumn(new Varchar('analytics'))
			->addColumn(new Text('params'))
			->create();

		$this->db->getTable('categories')
			->addColumn(new Primary('id'))
			->addColumn(new Integer('blog'))
			->addColumn(new Varchar('title'))
			->addColumn(new Varchar('alias'))
			->addColumn(new Varchar('image'))
			->addColumn(new Tinyint('state'))
			->addColumn(new Integer('ordering'))
			->addColumn(new Text('params'))
			->create();

		$this->db->getTable('users')
			->addColumn(new Primary('id'))
			->addColumn(new Varchar('username', 125))
			->addColumn(new Varchar('fullname', 255))
			->addColumn(new Varchar('email', 100))
			->addColumn(new Varchar('password', 100))
			->addColumn(new Varchar('password', 100))
			->addColumn(new Text('description'))
			->addColumn(new Varchar('image'))
			->addColumn(new Varchar('website'))
			->addColumn(new Tinyint('state'))
			->addColumn(new Char('timezone', 15))
			->addColumn(new Char('language', 7))
			->addColumn(new Varchar('activation', 100))
			->addColumn(new Timestamp('register_date'))
			->addColumn(new Timestamp('last_visit_date'))
			->addColumn(new Text('params'))
			->create();

		$this->db->getTable('authors')
			->addColumn(new Primary('id'))
			->addColumn(new Integer('user'))
			->addColumn(new Varchar('name'))
			->addColumn(new Text('description'))
			->addColumn(new Varchar('image'))
			->addColumn(new Varchar('website'))
			->create();

		$this->db->getTable('blog_author_maps')
			->addColumn(new Integer('blog'))
			->addColumn(new Integer('author'))
			->addColumn(new Tinyint('admin'))
			->addColumn(new Tinyint('default'))
			->create();

		$this->db->getTable('category_post_maps')
			->addColumn(new Integer('category'))
			->addColumn(new Integer('post'))
			->create();
	}

	/**
	 * Migrate Down.
	 */
	public function down()
	{
		$this->db->getTable('posts')->drop();
		$this->db->getTable('blogs')->drop();
		$this->db->getTable('categories')->drop();
		$this->db->getTable('users')->drop();
		$this->db->getTable('authors')->drop();
		$this->db->getTable('blog_author_maps')->drop();
		$this->db->getTable('category_post_maps')->drop();
	}
}
