<?php
use Windwalker\Core\Router\Router;

$root = $uri['base.path'];
?>
@extends('special-html')

@section('main_content')
<div class="middle-box text-center loginscreen  animated fadeInDown">
    <div>
        <div>
            <a href="{{{ Windwalker\Core\Router\Router::buildHtml('site:home') }}}">
                <h1 class="logo-name">WS</h1>
            </a>

        </div>
        <h3>Welcome to WindSpeaker</h3>

        {{\Windwalker\Core\View\Helper\PageHelper::showFlash($flashes)}}

        <form class="m-t" role="form" action="{{{ Router::buildHtml('user:login') }}}" method="post">
            <div class="form-group">
                <input type="text" name="user[username]" class="form-control" placeholder="Username" required="true">
            </div>
            <div class="form-group">
                <input type="password" name="user[password]" class="form-control" placeholder="Password" required="true">
            </div>

            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

            <a href="{{{ $uri['media.path'] }}}#"><small>Forgot password?</small></a>

            <p class="text-muted text-center">
                <small>Do not have an account?</small>
            </p>

            <a class="btn btn-sm btn-white btn-block" href="{{{ Router::buildHtml('user:registration') }}}">Create an account</a>
        </form>
        <p class="m-t"> <small>WindSpeaker &copy; {{{ $datetime->format('Y') }}}</small> </p>
    </div>
</div>
@stop
