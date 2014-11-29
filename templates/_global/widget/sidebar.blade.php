{{-- Part of windspeaker project. --}}
<?php
use Windwalker\Core\Router\Router;

$return = base64_encode($uri['current']);
?>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">

        @section('sidebar')
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <img alt="image" width="48" height="48" class="img-circle" src="{{{ \Admin\User\UserHelper::getAvatar($user->id, 48) }}}" />
                     </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="{{ $uri['media.path'] }}#">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{{ $user->fullname }}}</strong>
                     </span> <span class="text-muted text-xs block">{{{ $user->username }}} <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ Router::buildHttp('admin:profile'); }}">Profile</a></li>
                        <li><a href="http://windspeaker.uservoice.com/" target="_blank">Support</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ Router::buildHttp('user:logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    WS
                </div>
            </li>


            {{-- Articles --}}
            <li class="{{ $activeMenu == 'dashboard' ? 'active' : '' }}">
                <a href="{{ $uri['base.path'] }}">
                    <i class="fa fa-file-text fa-fw"></i>
                    <span class="menu-title">Articles</span>
                </a>
            </li>

            {{-- Static Pages --}}
            <li class="{{ $activeMenu == 'static' ? 'active' : '' }}">
                <a href="{{ $uri['base.path'] }}statics">
                    <i class="fa fa-file fa-fw"></i>
                    <span class="menu-title">Static Pages</span>
                </a>
            </li>

            {{-- Categories --}}
            <li class="{{ $activeMenu == 'categories' ? 'active' : '' }}">
                <a href="{{ $uri['base.path'] }}categories">
                    <i class="fa fa-folder fa-fw"></i>
                    <span class="menu-title">Categories</span>
                </a>
            </li>

            {{-- Settings --}}
            <li class="{{ $activeMenu == 'settings' ? 'active' : '' }}">
                <a href="{{ $uri['base.path'] }}settings">
                    <i class="fa fa-gear fa-fw"></i>
                    <span class="menu-title">Settings</span>
                </a>
            </li>

            {{-- Authors --}}
            <li class="{{ $activeMenu == 'authors' ? 'active' : '' }}">
                <a href="{{ $uri['base.path'] }}authors">
                    <i class="fa fa-group fa-fw"></i>
                    <span class="menu-title">Authors & Team</span>
                </a>
            </li>

            {{-- Blogs --}}
            <li class="{{ $activeMenu == 'blogs' ? 'active' : '' }}">
                <a href="{{ $uri['base.path'] }}blogs">
                    <i class="fa fa-book fa-fw"></i>
                    <span class="menu-title">Blogs</span>
                </a>
            </li>
        </ul>
        @show

    </div>
</nav>