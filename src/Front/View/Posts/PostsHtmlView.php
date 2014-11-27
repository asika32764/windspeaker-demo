<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */

namespace Front\View\Posts;

use Admin\Author\Author;
use Michelf\MarkdownExtra;
use Windwalker\Core\Router\Router;
use Windwalker\Core\View\BladeHtmlView;

/**
 * The PostsHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PostsHtmlView extends BladeHtmlView
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

		foreach ($data['posts'] as $post)
		{
			$post->link = Router::buildHtml('front:post_default', ['id' => $post->id, 'alias' => $post->alias]);
			$post->introtext = $markdown->defaultTransform($post->introtext);
			$post->author = Author::getPostAuthor($post->author);
		}

		foreach ($data['statics'] as $post)
		{
			$post->link = Router::buildHtml('front:static_default', ['id' => $post->id, 'alias' => $post->alias]);
		}

		if ($data->type == 'home')
		{
			$title = $data->blog->title;
			$suffix = '';
		}
		else
		{
			$title = '';
			$suffix = $data->blog->title;
		}

		$data->pageTitle =  $title;
		$data->pageTitle .= $data->page > 1 ? ' - Page ' . $data->page : '';
		$data->pageTitle .= $suffix ? '|' . $suffix : '';
	}
}
 