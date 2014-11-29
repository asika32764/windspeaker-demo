<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\View\Post;

use Joomla\Date\Date;
use Michelf\MarkdownExtra;
use Windwalker\Core\Router\Router;
use Windwalker\Core\View\BladeHtmlView;
use Windwalker\Filter\OutputFilter;
use Windwalker\String\Utf8String;

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

		$data['post']->created = new Date($data['post']->created);
		$data['post']->created = $data['post']->created->format('F j, Y');

		foreach ($data['statics'] as $post)
		{
			$post->link = Router::buildHtml('front:static_default', ['id' => $post->id, 'alias' => $post->alias]);
		}

		$data->bodyClass = $data['type'] ? : 'post';

		// Meta
		$text = $data['post']->text;
		$desc = trim($data['post']->metadesc);
		$desc = $desc ? : Utf8String::substr(OutputFilter::cleanText($text), 0, 200);

		$data->meta->desc = $desc;
	}
}
