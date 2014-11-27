<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Form;

use Admin\Form\Field\AuthorsField;
use Admin\Form\Field\CategoriesField;
use Windwalker\Data\Data;
use Windwalker\Form\Field\ListField;
use Windwalker\Form\Field\RadioField;
use Windwalker\Form\Field\TextareaField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;
use Windwalker\Html\Option;

/**
 * The PostDefinition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PostDefinition implements FieldDefinitionInterface
{
	/**
	 * Property blog.
	 *
	 * @var Data
	 */
	protected $blog;

	/**
	 * Class init.
	 *
	 * @param Data $blog
	 */
	public function __construct(Data $blog = null)
	{
		$this->blog = $blog ? : new Data;
	}

	/**
	 * Define the form fields.
	 *
	 * @param Form $form The Windwalker form object.
	 *
	 * @return  void
	 */
	public function define(Form $form)
	{
		$form->addField(new TextareaField('metadesc', 'Meta Description'))
			->set('class', 'form-control')
			->set('rows', 5);

		$form->addField(new CategoriesField('category', 'Categories'))
			->set('class', 'chosen-select form-control')
			->set('multiple', true)
			->setBlog($this->blog->id);

		$form->addField(new ListField('state', 'State'))
			->setOptions(array(
					new Option('Publish', 1),
					new Option('Unpublish', 0)
			))->set('class', 'form-control');

		$form->addField(new AuthorsField('author', 'Author'))
			->setOptions(array(
				new Option('- Select Author -', '0')
			))->set('class', 'form-control')
			->setBlog($this->blog->id);
	}
}
 