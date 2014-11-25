@extends('special-html')

@section('page_title')
Registration
@stop

@section('main_content')
<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">REGISTRATION</h1>

        </div>
        <h3>Register to WindSpaker</h3>
        <p>Create account to blogging.</p>

        {{\Windwalker\Core\View\Helper\PageHelper::showFlash($flashes)}}

        <form class="m-t" role="form" action="{{{ \Windwalker\Core\Router\Router::buildHttp('user:registration') }}}" method="post">
            <div class="form-group">
                <input type="text" name="registration[username]" class="form-control" placeholder="Username" value="{{{ $item['username'] }}}">
            </div>
            <div class="form-group">
                <input type="email" name="registration[email]" class="form-control" placeholder="Email" value="{{{ $item['email'] }}}">
            </div>
            <div class="form-group">
                <input type="password" name="registration[password]" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" name="registration[password2]" class="form-control" placeholder="Password again">
            </div>
            <div class="form-group">
                    <div class="checkbox i-checks">
                        <label>
                            <input type="checkbox" name="registration[tos]" value="1"><i></i> Agree the <a href="#" target="_blank">terms and policy</a>
                        </label>
                    </div>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

            <p class="text-muted text-center"><small>Already have an account?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="{{{ \Windwalker\Core\Router\Router::buildHtml('user:login') }}}">Login</a>
        </form>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div>
@stop

