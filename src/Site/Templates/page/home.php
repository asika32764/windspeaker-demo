<?php
/**
 * Part of windspeaker project. 
 *
 * @copyright  Copyright (C) 2014 {ORGANIZATION}. All rights reserved.
 * @license    GNU General Public License version 2 or later;
 */
use Windwalker\Core\Router\Router;

$num = 6;
$banners = \Site\Banner\Banner::getBanners($num);
shuffle($banners);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">

	<title>WindSpeaker - A Markdown Blog For Your Team</title>

	<link href="<?php echo $data->uri['media.path'] ?>images/favicon.ico" rel="shortcut icon"/>

	<link rel="stylesheet" href="<?php echo $data->uri['media.path'] ?>css/uikit.min.css" />
	<link rel="stylesheet" href="<?php echo $data->uri['media.path'] ?>css/site/site.css" />

	<script src="<?php echo $data->uri['media.path'] ?>js/jquery-2.1.1.js"></script>
	<script src="<?php echo $data->uri['media.path'] ?>js/uikit.min.js"></script>
	<script>
		var banners = <?php echo json_encode($banners); ?>;
		var i = 1;
		var max = <?php echo $num; ?>;

		var changeBanner = function()
		{
			var main  = $('body');
			var tran  = $('#banner');

			tran.css('background-image', main.css('background-image'));
			tran.css('display', 'block');
			main.css('background-image', 'url(' + banners[i - 1] + ')');
			tran.fadeOut();

			i = (i == max) ? 1 : i + 1;

			setTimeout(changeBanner, 10000);
		};

		function getRandomInt(min, max)
		{
			return Math.floor(Math.random() * (max - min + 1)) + min;
		}

		setTimeout(changeBanner, 10000);
	</script>
</head>
<body style="background-image: url(<?php echo $banners[$num - 1]; ?>);">

	<nav id="header" class="uk-navbar uk-navbar-attached ">
		<div class="uk-container uk-container-center">

			<h1 id="blog-title">
				<a id="big-logo" class="uk-navbar-brand" href="<?php echo Router::buildHtml('site:home') ?>">
					WindSpeaker
				</a>
			</h1>

			<a href="#" class="uk-navbar-toggle uk-visible-small" data-uk-toggle="{target:'#mainmenu', cls: 'uk-hidden-small'}"></a>

			<a id="small-logo" class="uk-navbar-brand uk-navbar-center uk-visible-small" href="<?php echo Router::buildHtml('site:home') ?>">
				WindSpeaker
			</a>

			<ul id="mainmenu" class="uk-navbar-nav uk-float-right uk-hidden-small">
				<li class="">
					<a href="<?php echo Router::buildHtml('user:login') ?>">Login</a>
				</li>
				<li class="">
					<a href="<?php echo Router::buildHtml('user:registration') ?>">Register</a>
				</li>
				<li class="">
					<a href="mailto:asika32764@gmail.com">Contact</a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="banner-cover">
		<section id="banner" style="background-image: url(<?php echo $banners[$num - 1]; ?>);">
			<div class="banner-cover"></div>
		</section>
	</div>

	<section class="banner-inner middle-box">
		<h1>Simple Platform For Team Blogging</h1>
		<h2>
			Share interesting things in you and your friends' life.
		</h2>
		<p>
			<a class="btn start-button" href="<?php echo Router::buildHtml('user:registration') ?>">Start</a>
		</p>
	</section>

</body>
</html>
