<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('page_title', 'Dashboard') | Windspeaker</title>

    <link href="{{ $uri['media.path'] }}css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ $uri['media.path'] }}font-awesome/css/font-awesome.css" rel="stylesheet">

    {{--<!-- Morris -->--}}
    {{--<link href="{{ $uri['media.path'] }}css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">--}}

    {{--<!-- Gritter -->--}}
    {{--<link href="{{ $uri['media.path'] }}js/plugins/gritter/jquery.gritter.css" rel="stylesheet">--}}

    <link href="{{ $uri['media.path'] }}css/animate.css" rel="stylesheet">
    <link href="{{ $uri['media.path'] }}css/style.css" rel="stylesheet">
    <link href="{{ $uri['media.path'] }}css/main.css" rel="stylesheet">

</head>

<body class="{{{ $hideMenu ? 'mini-navbar' : '' }}}">
    <div id="wrapper">
        <!--BEGIN SIDEBAR MENU-->
        @include('widget.sidebar')
        <!--END SIDEBAR MENU-->

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="javascript:void(0);" {{ $hideMenu ? 'disabled' : '' }}>
                <i class="fa fa-bars"></i>
            </a>

            <?php
            use Windwalker\Core\Router\Router;

            $return = base64_encode($uri['current']);
            ?>

            <div class="blog-selector btn-group pull-left">
                <button type="button" data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" {{ $hideMenu ? 'disabled' : '' }}>
                    <span class="current-blog-inner">{{{ $blog->title }}}</span>
                    &nbsp;<i class="fa fa-angle-down"></i>
                </button>
                <ul role="menu" class="dropdown-menu">
                    @if ($blogs)
                        @foreach ($blogs as $item)
                        <li class="{{{ $blog->id == $item->id ? 'active' : '' }}}">
                            <a href="{{{ Router::buildHtml('admin:switchblog', ['id' => $item->id, 'return' => $return]) }}}">{{{ $item->title }}}</a>
                        </li>
                        @endforeach
                        <li class="divider"></li>
                    @endif
                    <li><a href="#">Add New Blog</a></li>
                </ul>
            </div>
        </div>
            <ul class="nav navbar-top-links navbar-right">

                <li>
                    <a href="{{{ \Windwalker\Core\Router\Router::buildHtml('user:logout') }}}">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>

        <div class="row  border-bottom white-bg dashboard-header">
            <div class="pull-left">
                <h2>@yield('page_title', 'Dashboard')</h2>
                @yield('title_bar')
            </div>
            <div class="pull-right banner-toolbar">
                @yield('toolbar')
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                    {{\Windwalker\Core\View\Helper\PageHelper::showFlash($flashes)}}

                    @yield('main_content')

                    @if (WINDWALKER_DEBUG)
                    <hr/>
                    <div class="panel panel-primary">
                        <div class="panel-heading">Debug Information</div>
                        <div class="panel-body">
                            {{ $profiler->render(); }}
                        </div>
                    </div>
                    <hr/>
                    <div class="panel panel-success">
                        <div class="panel-heading">Session Information</div>
                        <div class="panel-body">
                            {{ show($_SESSION); }}
                        </div>
                    </div>
                    @endif
                </div>
                <div class="footer">
                    <div class="pull-right">
                        10GB of <strong>250GB</strong> Free.
                    </div>
                    <div>
                        <strong>Copyright</strong> Example Company &copy; 2014-2015
                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ $uri['media.path'] }}js/jquery-2.1.1.js"></script>
    <script src="{{ $uri['media.path'] }}js/bootstrap.min.js"></script>
    <script src="{{ $uri['media.path'] }}js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ $uri['media.path'] }}js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    {{--<script src="{{ $uri['media.path'] }}js/plugins/flot/jquery.flot.js"></script>--}}
    {{--<script src="{{ $uri['media.path'] }}js/plugins/flot/jquery.flot.tooltip.min.js"></script>--}}
    {{--<script src="{{ $uri['media.path'] }}js/plugins/flot/jquery.flot.spline.js"></script>--}}
    {{--<script src="{{ $uri['media.path'] }}js/plugins/flot/jquery.flot.resize.js"></script>--}}
    {{--<script src="{{ $uri['media.path'] }}js/plugins/flot/jquery.flot.pie.js"></script>--}}

    <!-- Peity -->
    {{--<script src="{{ $uri['media.path'] }}js/plugins/peity/jquery.peity.min.js"></script>--}}
    {{--<script src="{{ $uri['media.path'] }}js/demo/peity-demo.js"></script>--}}

    <!-- Custom and plugin javascript -->
    <script src="{{ $uri['media.path'] }}js/inspinia.js"></script>
    <script src="{{ $uri['media.path'] }}js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="{{ $uri['media.path'] }}js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    {{--<script src="{{ $uri['media.path'] }}js/plugins/gritter/jquery.gritter.min.js"></script>--}}

    <!-- EayPIE -->
    {{--<script src="{{ $uri['media.path'] }}js/plugins/easypiechart/jquery.easypiechart.js"></script>--}}

    <!-- Sparkline -->
    {{--<script src="{{ $uri['media.path'] }}js/plugins/sparkline/jquery.sparkline.min.js"></script>--}}

    {{--<!-- Sparkline demo data  -->--}}
    {{--<script src="{{ $uri['media.path'] }}js/demo/sparkline-demo.js"></script>--}}

    {{--<!-- ChartJS-->--}}
    {{--<script src="{{ $uri['media.path'] }}js/plugins/chartJs/Chart.min.js"></script>--}}

    @yield('script')

    <script src="{{ $uri['media.path'] }}js/windspeaker.js"></script>

    <script>
        $(document).ready(function() {


        });
    </script>
</body>
</html>
