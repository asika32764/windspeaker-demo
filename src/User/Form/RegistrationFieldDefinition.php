<?php
/**
 * Part of starter project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace User\Form;

use Faker\Factory;
use Windwalker\Form\Field\EmailField;
use Windwalker\Form\Field\PasswordField;
use Windwalker\Form\Field\TextField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;

/**
 * The RegistrationFieldDefainition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class RegistrationFieldDefinition implements FieldDefinitionInterface
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
		// $faker = Factory::create();

		$form->addField(new TextField('username'))
			->label('Username')
			->required();

		$form->addField(new TextField('name'))
			->label('Name')
			->required();

		$form->addField(new PasswordField('password'))
			->label('Password')
			->required();

		$form->addField(new PasswordField('password2'))
			->set('default', 1234)
			->label('Valid Password');

		$form->addField(new EmailField('email'))
			->label('Email')
			->required();
	}
}
