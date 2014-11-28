<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Form;

use Windwalker\Form\Field\CheckboxField;
use Windwalker\Form\Field\HiddenField;
use Windwalker\Form\Field\ListField;
use Windwalker\Form\Field\RadioField;
use Windwalker\Form\Field\TextareaField;
use Windwalker\Form\Field\TextField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;
use Windwalker\Html\Option;

/**
 * The AuthorDefintion class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class AuthorDefinition implements FieldDefinitionInterface
{
	/**
	 * Define the form fields.
	 *
	 * @param Form $form The Windwalker form object.
	 *
	 * @return  void
	 */
	public function define(Form $form)
	{
		$form->addField(new TextField('name', 'Name'), 'author')
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label')
			->required();

		$form->addField(new TextareaField('description', 'Description'), 'author')
			->set('class', 'form-control')
			->set('rows', 5)
			->set('labelClass', 'col-sm-3 control-label');

//		$form->addField(new ListField('admin', 'Is Admin'), 'author')
//			->setOptions([
//				new Option('Yes', 1),
//				new Option('No', 0)
//			])
//			->set('class', 'form-control')
//			->set('labelClass', 'col-sm-3 control-label');

		$form->addField(new HiddenField('uuid'), 'hidden');
	}
}
