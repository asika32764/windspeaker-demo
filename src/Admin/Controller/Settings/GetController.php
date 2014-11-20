<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Admin\Controller\Settings;

use Admin\Controller\AbstractAdminController;
use Admin\Form\BlogDefinition;
use Admin\View\Settings\SettingsHtmlView;
use Windwalker\Form\Form;

/**
 * The GetController class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class GetController extends AbstractAdminController
{
	/**
	 * doExecute
	 *
	 * @return  string
	 */
	protected function doExecute()
	{
		$view = new SettingsHtmlView($this->data);

		$form = new Form('blog');
		$form->defineFormFields(new BlogDefinition);

		$form->bind($view['blog']);

		$view['form'] = $form;

		return $view->render();
	}
}
 