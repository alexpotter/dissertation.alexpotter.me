@extends('admin/base')

@section('title', 'SBCDS Admin')

@section('content')
    <section id="main">
        <div class="login-container-outer">
            <div class="container login-container-inner">
                <div class="card card-container">
                    <h2 style="text-align: center;">SBCDS</h2>
                    <p id="profile-name" class="profile-name-card"></p>
                    @if (session('csrf_error'))
                        <div class="alert alert-danger">
                            {{ session('csrf_error') }}
                        </div>
                    @endif
                    @if (session('message-with-error'))
                        <div class="alert alert-danger">
                            {{ session('message-with-error') }}
                        </div>
                    @endif
                    @if (session('message-with-warning'))
                        <div class="alert alert-warning">
                            {{ session('message-with-warning') }}
                        </div>
                    @endif
                    @if (session('message-with-success'))
                        <div class="alert alert-success">
                            {{ session('message-with-success') }}
                        </div>
                    @endif
                    <form class="form-signin" action="{{url('admin/login')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <span id="reauth-username" class="reauth-username"></span>
                        @if ((!session('_old_input')['username']) || (session('_old_input')['username'] == ""))
                            <input type="username" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
                            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                        @else
                            <input type="username" name="username" id="inputUsername" class="form-control" placeholder="Username" value="{{ session('_old_input')['username'] }}" required>
                            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required autofocus>
                        @endif
                        <div id="remember" class="checkbox">
                            <label>
                                <input type="checkbox" value="remember-me"> Remember me
                            </label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
                    </form><!-- /form -->
                </div><!-- /card-container -->
            </div><!-- /container -->
        </div>
    </section>
@endsection