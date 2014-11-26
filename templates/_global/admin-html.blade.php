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
        {{ $widget->sidebar }}
        <!--END SIDEBAR MENU-->

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#">
                <i class="fa fa-bars"></i>
            </a>

            <?php
            use Windwalker\Core\Router\Router;

            $return = base64_encode($uri['current']);
            ?>

            <div class="blog-selector btn-group pull-left">
                <button type="button" data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">
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
                    <span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+ Admin Theme.</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="{{ $uri['media.path'] }}#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="{{ $uri['media.path'] }}profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{ $uri['media.path'] }}img/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="{{ $uri['media.path'] }}profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{ $uri['media.path'] }}img/a4.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="{{ $uri['media.path'] }}profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="{{ $uri['media.path'] }}img/profile.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="{{ $uri['media.path'] }}mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="{{ $uri['media.path'] }}#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="{{ $uri['media.path'] }}mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ $uri['media.path'] }}profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ $uri['media.path'] }}grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="{{ $uri['media.path'] }}notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="{{{ \Windwalker\Core\Router\Router::buildHtml('user:logout') }}}">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>

        <div class="row  border-bottom white-bg dashboard-header">
            <h2>@yield('page_title', 'Dashboard')</h2>
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
