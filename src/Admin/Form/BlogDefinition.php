<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Form;

use Windwalker\Form\Field\TextareaField;
use Windwalker\Form\Field\TextField;
use Windwalker\Form\Field\TimezoneField;
use Windwalker\Form\FieldDefinitionInterface;
use Windwalker\Form\Form;

/**
 * The BlogDefinition class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class BlogDefinition implements FieldDefinitionInterface
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
		$form->addField(new TextField('alias', 'Blog Name'), 'basic')
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label')
			->required();

		// $form->addField(new TextField('domain'));

		$form->addField(new TextField('title', 'Blog Title'), 'basic')
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label')
			->required();

		$form->addField(new TextField('sub_title', 'Sub Title'), 'basic')
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label');

		$form->addField(new TextareaField('description', 'Description'), 'basic')
			->set('class', 'form-control')
			->set('rows', 5)
			->set('labelClass', 'col-sm-3 control-label');

		$form->addField(new TimezoneField('timezone', 'Timezone'), 'other')
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label')
			->set('default', 'UTC')
			->required();

		$form->addField(new TextField('disqus', 'Disqus Shortname'), 'other')
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label');

		$form->addField(new TextField('webmaster', 'Google Webmaster'), 'other')
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label');

		$form->addField(new TextField('analytics', 'Analytics'), 'other')
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label');

		$form->addField(new TextareaField('css', 'Custom CSS'), 'style', 'params')
			->set('class', 'form-control')
			->set('labelClass', 'col-sm-3 control-label');
	}
}
 