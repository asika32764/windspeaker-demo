<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">

    <title>@yield('page_title')</title>

    <link href="{{{ $uri['media.path'] }}}images/favicon.ico" rel="shortcut icon"/>

@if ($type == 'home')
    <meta property="og:image" content="http://windspeaker.s3.amazonaws.com/logo/WindSpeaker-logo-sq-big.png">
@endif
    <meta property="og:title" content="@yield('page_title')">
    <meta property="og:site_name" content="{{{ $blog->title }}}">
@if ($meta->desc)
    <meta property="og:description" content="{{{ $meta->desc }}}">
@endif

@if ($blog['webmaster'])
    <meta name="google-site-verification" content="{{{ $blog['webmaster'] }}}" />
@endif
    <link href="{{{ \Windwalker\Core\Router\Router::buildHtml('front:feed') }}}" rel="alternate" title="{{{ $blog->title }}}" type="application/rss+xml">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/uikit/2.12.0/css/uikit.min.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/styles/rainbow.min.css"/>
    <link rel="stylesheet" href="{{{ $uri['media.path'] . 'css/front/default.css' }}}"/>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/uikit/2.12.0/js/uikit.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/8.4/highlight.min.js"></script>

@if ($blog['disqus'])
    <script>
        var disqus_shortname = '{{{ $blog['disqus'] }}}';
        (function () {
            var s = document.createElement('script'); s.async = true;
            s.type = 'text/javascript';
            s.src = '//' + disqus_shortname + '.disqus.com/count.js';
            (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
        }());
    </script>
@endif

@if ($blog->params['css'])
<style>
{{ \Windwalker\Filter\OutputFilter::stripScript($blog->params['css']) }}
</style>
@endif
    <script>
    $(document).ready(function() {
        $('.article-content pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
    });
    </script>
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-56999283-1', 'auto');
@if ($blog['analytics'])
      ga('create', '{{{ $blog['analytics'] }}}', 'auto', {'name': '{{{ $blog['alias'] }}}'});
@endif
      ga('send', 'pageview');

    </script>
</head>
<body class="{{{ $bodyClass }}} @yield('body_class')">
    @section('banner')
    {{-- NAV --}}
    <nav id="header" class="uk-navbar uk-navbar-attached ">
    	<div class="uk-container uk-container-center">

    		<h1 id="blog-title">
    		    <a id="big-logo" class="uk-navbar-brand" href="{{{ $blog->link }}}">
                    {{{ $blog->title }}}
                </a>
    		</h1>

    		@if ($blog->sub_title)
    		<div id="blog-sub-title">
                <small>
                {{{ $blog->sub_title }}}
                </small>
    		</div>
    		@endif

    		<a href="#" class="mobile-button uk-navbar-toggle uk-visible-small" data-uk-toggle="{target:'#mainmenu', cls: 'uk-hidden-small'}"></a>

    		<ul id="mainmenu" class="uk-navbar-nav uk-float-right uk-hidden-small">
    			@foreach($statics as $k => $static)
    			<li class="">
    			    <a href="{{{ $static->link }}}">{{{ $static->title }}}</a>
    			</li>
    			@endforeach
    		</ul>
    	</div>
    </nav>

    <section id="banner">
        <div class="banner-inner">

        </div>
    </section>
    @show

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

    <div id="control-tools">
        <h4>Control Tools</h4>
        <a class="dashboard-button" href="http://windspeaker.co" target="_blank">
            <img width="26" src="{{{ $uri['media.path'] }}}images/logo/windspeaker-logo-200.png" alt="WS-logo"/>
        </a>
    </div>

    <footer id="footer">
    	<div class="uk-container uk-container-center uk-text-center">

    		<div class="footer-logo">
    			<a href="#" data-uk-smooth-scroll>
    				<img src="{{{ $uri['media.path'] }}}images/logo/windspeaker-logo-200.png" width="150" alt="Footer LOGO"></a>
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