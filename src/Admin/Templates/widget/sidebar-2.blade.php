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
                <a href="{{ $uri['base.path'] }}">
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
        </ul>
    </div>
</nav>