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
use Suin\RSSWriter\Channel;
use Suin\RSSWriter\Feed;
use Suin\RSSWriter\Item;
use Windwalker\Core\Router\Router;
use Windwalker\Core\View\HtmlView;
use Windwalker\Filter\OutputFilter;

/**
 * The PostsHtmlView class.
 * 
 * @since  {DEPLOY_VERSION}
 */
class PostsFeedView extends HtmlView
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
	}

	/**
	 * Method to render the view.
	 *
	 * @return  string  The rendered view.
	 *
	 * @throws  \RuntimeException
	 */
	public function render()
	{
		$this->prepareGlobals($this->getData());
		$this->prepareData($this->getData());

		$feed = new Feed;

		$channel = new Channel;
		$channel
			->title($this['blog']->title)
			->description($this['blog']->description)
			->url($this['uri']->get('base.full'))
			->appendTo($feed);

		foreach ($this['posts'] as $post)
		{
			$item = new Item;
			$item->title($post->title)
				->description($post->introtext)
				->url($this['uri']->get('base.full') . ltrim($post->link, '/'))
				->appendTo($channel);
		}

		return $feed;
	}
}
 