{{-- Part of windspeaker project. --}}
<?php
use Windwalker\Core\Router\Router;

$return = base64_encode($uri['current']);
?>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">

        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                    <img alt="image" class="img-circle" src="{{ $uri['media.path'] }}img/profile_small.jpg" />
                     </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="{{ $uri['media.path'] }}#">
                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                     </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ $uri['media.path'] }}profile.html">Profile</a></li>
                        <li><a href="{{ $uri['media.path'] }}contacts.html">Contacts</a></li>
                        <li><a href="{{ $uri['media.path'] }}mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ $uri['media.path'] }}login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>

            <li>
                <div class="btn-group">
                    <button type="button" data-toggle="dropdown"  style="max-width: 200px;" class="btn btn-primary dropdown-toggle">
                        <span class="current-blog-inner">{{{ $blog->title }}}</span>
                        &nbsp;<i class="fa fa-angle-down"></i>
                    </button>
                    <ul role="menu" class="dropdown-menu">
                        @if ($blogs)
                            @foreach ($blogs as $item)
                            <li class="">
                                <a href="{{{ Router::buildHtml('admin:switchblog', ['id' => $item->id, 'return' => $return]) }}}">{{{ $item->title }}}</a>
                            </li>
                            @endforeach
                            <li class="divider"></li>
                        @endif
                        <li><a href="#">Add New Blog</a></li>
                    </ul>
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

    </div>
</nav>