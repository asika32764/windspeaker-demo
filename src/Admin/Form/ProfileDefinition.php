<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Form;

use Windwalker\Form\Field\EmailField;
use Windwalker\Form\Field\HiddenField;
use Windwalker\Form\Field\PasswordField;
use Windwalker\Form\Field\TextareaField;
use Windwalker\Form\Field\TextField;
use Windwalker\Form\Field\TimezoneField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;

/**
 * The ProfileDefinition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class ProfileDefinition implements FieldDefinitionInterface
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
		$form->addField(new TextField('username', 'Username'))
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label')
			->disabled();

		$form->addField(new TextField('fullname', 'Full Name'))
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label')
			->required();

		$form->addField(new EmailField('email', 'Email'))
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label')
			->required();

		$form->addField(new TextareaField('description', 'Description'))
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label')
			->set('rows', 5);

		$form->addField(new TimezoneField('timezone', 'Timezone'), 'other')
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label')
			->required();

		$form->addField(new TextField('website', 'Website'))
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label');

		$form->addField(new TextField('website', 'Website'))
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label');

		$form->addField(new PasswordField('password', 'Password'))
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label')
			->set('autocomplete', 'off');

		$form->addField(new PasswordField('password2', 'Verify Password'))
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label')
			->set('autocomplete', 'off');
	}
}
 