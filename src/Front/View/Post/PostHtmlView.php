<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\View\Post;

use Michelf\MarkdownExtra;
use Windwalker\Core\Router\Router;
use Windwalker\Core\View\BladeHtmlView;

/**
 * The PostHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PostHtmlView extends BladeHtmlView
{
	/**
	 * prepareData
	 *
	 * @param \Windwalker\Data\Data $data
	 *
	 * @return  void
	 */
	protected function prepareData($data)
	{
		$markdown = new MarkdownExtra;

		$text = $data['post']->introtext . $data['post']->fulltext;

		$data['post']['text'] = $markdown->defaultTransform($text);
		$data['post']['link'] = Router::buildHttp('front:post_default', ['id' => $data['post']['id'], 'alias' => $data['post']['alias']]);
	}
}
