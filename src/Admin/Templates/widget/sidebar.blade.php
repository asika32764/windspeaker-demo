{{-- Part of windspeaker project. --}}
<?php
use Windwalker\Core\Router\Router;
?>

<nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
    data-position="right" class="navbar-default navbar-static-side">
    <div class="sidebar-collapse menu-scroll">
        <div class="btn-group">
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">
                <span class="current-blog-inner">{{{ $blog->title }}}</span>
                &nbsp;<i class="fa fa-angle-down"></i>
            </button>
            <ul role="menu" class="dropdown-menu">
                @if ($blogs)
                    @foreach ($blogs as $item)
                    <li class="">
                        <a href="{{{ $uri['base.path'] }}}{{{ Router::build('admin:switchblog', ['id' => $item->id]) }}}">{{{ $item->title }}}</a>
                    </li>
                    @endforeach
                    <li class="divider"></li>
                @endif
                <li><a href="#">Add New Blog</a></li>
            </ul>
        </div>

        <ul id="side-menu" class="nav">

            <div class="clearfix"></div>

            {{-- Articles --}}
            <li class="{{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                <a href="{{ $uri['base.path'] }}dashboard">
                    <i class="fa fa-tachometer fa-fw"></i>
                    <span class="menu-title">Articles</span>
                </a>
            </li>

            {{-- Static Pages --}}
            <li class="{{ $activeMenu == 'static' ? 'active' : '' }}">
                <a href="{{ $uri['base.path'] }}statics">
                    <i class="fa fa-tachometer fa-fw"></i>
                    <span class="menu-title">Static Pages</span>
                </a>
            </li>

            {{-- Categories --}}
            <li class="{{ $activeMenu == 'categories' ? 'active' : '' }}">
                <a href="{{ $uri['base.path'] }}categories">
                    <i class="fa fa-tachometer fa-fw"></i>
                    <span class="menu-title">Categories</span>
                </a>
            </li>

            {{-- Settings --}}
            <li class="{{ $activeMenu == 'settings' ? 'active' : '' }}">
                <a href="{{ $uri['base.path'] }}settings">
                    <i class="fa fa-tachometer fa-fw"></i>
                    <span class="menu-title">Settings</span>
                </a>
            </li>

            {{-- Settings --}}
            <li class="{{ $activeMenu == 'authors' ? 'active' : '' }}">
                <a href="{{ $uri['base.path'] }}authors">
                    <i class="fa fa-tachometer fa-fw"></i>
                    <span class="menu-title">Authors & Team</span>
                </a>
            </li>

            {{--<li><a href="Layout.html"><i class="fa fa-desktop fa-fw">--}}
                {{--<div class="icon-bg bg-pink"></div>--}}
            {{--</i><span class="menu-title">Layouts</span></a>--}}
               {{----}}
            {{--</li>--}}
            {{--<li><a href="UIElements.html"><i class="fa fa-send-o fa-fw">--}}
                {{--<div class="icon-bg bg-green"></div>--}}
            {{--</i><span class="menu-title">UI Elements</span></a>--}}
               {{----}}
            {{--</li>--}}
            {{--<li><a href="Forms.html"><i class="fa fa-edit fa-fw">--}}
                {{--<div class="icon-bg bg-violet"></div>--}}
            {{--</i><span class="menu-title">Forms</span></a>--}}
              {{----}}
            {{--</li>--}}
            {{--<li><a href="Tables.html"><i class="fa fa-th-list fa-fw">--}}
                {{--<div class="icon-bg bg-blue"></div>--}}
            {{--</i><span class="menu-title">Tables</span></a>--}}
                  {{----}}
            {{--</li>--}}
            {{--<li><a href="DataGrid.html"><i class="fa fa-database fa-fw">--}}
                {{--<div class="icon-bg bg-red"></div>--}}
            {{--</i><span class="menu-title">Data Grids</span></a>--}}
              {{----}}
            {{--</li>--}}
            {{--<li><a href="Pages.html"><i class="fa fa-file-o fa-fw">--}}
                {{--<div class="icon-bg bg-yellow"></div>--}}
            {{--</i><span class="menu-title">Pages</span></a>--}}
               {{----}}
            {{--</li>--}}
            {{--<li><a href="Extras.html"><i class="fa fa-gift fa-fw">--}}
                {{--<div class="icon-bg bg-grey"></div>--}}
            {{--</i><span class="menu-title">Extras</span></a>--}}
              {{----}}
            {{--</li>--}}
            {{--<li><a href="Dropdown.html"><i class="fa fa-sitemap fa-fw">--}}
                {{--<div class="icon-bg bg-dark"></div>--}}
            {{--</i><span class="menu-title">Multi-Level Dropdown</span></a>--}}
              {{----}}
            {{--</li>--}}
            {{--<li><a href="Email.html"><i class="fa fa-envelope-o">--}}
                {{--<div class="icon-bg bg-primary"></div>--}}
            {{--</i><span class="menu-title">Email</span></a>--}}
              {{----}}
            {{--</li>--}}
            {{--<li><a href="Charts.html"><i class="fa fa-bar-chart-o fa-fw">--}}
                {{--<div class="icon-bg bg-orange"></div>--}}
            {{--</i><span class="menu-title">Charts</span></a>--}}
               {{----}}
            {{--</li>--}}
            {{--<li><a href="Animation.html"><i class="fa fa-slack fa-fw">--}}
                {{--<div class="icon-bg bg-green"></div>--}}
            {{--</i><span class="menu-title">Animations</span></a></li>--}}
        </ul>
    </div>
</nav>