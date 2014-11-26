<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('page_title') | @yield('blog_title')</title>

    <link rel="stylesheet" href="{{{ $uri['media.path'] . '/css/uikit.min.css' }}}"/>
    <link rel="stylesheet" href="{{{ $uri['media.path'] . '/css/front/default.css' }}}"/>

    <script src="{{{ $uri['media.path'] . '/js/uikit.min.js' }}}"></script>
</head>
<body>
    {{-- NAV --}}
    <nav id="header" class="uk-navbar uk-navbar-attached ">
    	<div class="uk-container uk-container-center">

    		<h1 id="blog-title">
    		    <a id="big-logo" class="uk-navbar-brand uk-hidden-small" href="http://asukademy.com">
                    {{{ $blog->title }}}
                </a>
    		</h1>


    		<a href="#" class="uk-navbar-toggle uk-visible-small" data-uk-toggle="{target:'#mainmenu', cls: 'uk-hidden-small'}"></a>

    		<a id="small-logo" class="uk-navbar-brand uk-navbar-center uk-visible-small" href="http://asukademy.com">
    			<img class="uk-margin uk-margin-remove" style="max-width: 95%;" src="http://asukademy.com/media/img/asukademy-logo-horz.png" title="Asukademy" alt="Asukademy"></a>

    		<ul id="mainmenu" class="uk-navbar-nav uk-float-right uk-hidden-small">
    			@foreach($statics as $k => $static)
    			<li class="">
    			    <a href="{{{ $static->link }}}">{{{ $static->title }}}</a>
    			</li>
    			@endforeach
    		</ul>
    	</div>
    </nav>

    {{-- BODY --}}
    <div id="main-body" class="basic-layout">
    	<section id="basic-section" class="main-block">
    		<div class="uk-container uk-container-center">
    			<div class="uk-width-medium-4-6 uk-container-center">

                    @yield('main_content')

    			</div>
    		</div>
    	</section>
    </div>

    <footer id="footer">
    	<div class="uk-container uk-container-center uk-text-center">

    		<div class="footer-logo">
    			<a href="#" data-uk-smooth-scroll>
    				<img src="http://asukademy.com/media/img/asukademy-logo-hex.png" width="150" alt="Footer LOGO"></a>
    		</div>

    		{{--<p class="uk-text-center social-buttons">--}}
    			{{--<a target="_blank" class="uk-icon-button uk-icon-facebook" href="https://fb.me/asukademy"></a>--}}

    			{{--<a target="_blank" class="uk-icon-button uk-icon-github" href="https://github.com/asukademy"></a>--}}

    			{{--<a class="uk-icon-button uk-icon-envelope-o" href="mailto:asika32764@gmail.com"></a>--}}
    		{{--</p>--}}

    		<p>
    			Copyright © 2014 {{{ $ownerUser->fullname }}}. All Rights Reserved.
    		</p>
    		<p>
    		    Powered by <a href="http://windspeaker.co">WindSpeaker</a>
    		</p>
    		<p class="back">
    			<a href="#" data-uk-smooth-scroll><span class="uk-icon-chevron-up"></span> Back to Top</a>
    		</p>
    	</div>
    </footer>
</body>
</html>