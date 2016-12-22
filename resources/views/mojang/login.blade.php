@extends('layouts.app')

@section('breadcrumb')
<li class="active">Mojang Login</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Logging into Capes API</h3>
                </div>
                <div class="panel-body">
                    <p>
                        This is where you, as a user, log into our system with your Mojang username and password.
                    </p>
                    <p>
                        We will always have people complaining and say that we are stealing your username and password.
                        The best we can do besides assuring you that your username and password are sent directly to Mojang,
                        is to remind you that the CapesAPI system is <a href="https://github.com/halfpetal/CapesAPI" target="_blank">
                        open-source on GitHub</a> and the exact line where your information is used is <a href="https://github.com/halfpetal/CapesAPI/blob/master/app/Http/Controllers/Mojang/AuthController.php#L54"
                        target="_blank">here</a>.
                    </p>
                    <p>
                        If you're still curious or have no programming knowledge, here's the entire process explained in steps...
                        <ol>
                            <li>You type in your username/password</li>
                            <li>You submit the information</li>
                            <li>The info is sent to Mojang</li>
                            <li>Mojang responds</li>
                            <li>We check response</li>
                            <li>If valid we store session data (username, token, uuid)
                                <br/>
                                If invalid, we process the error and tell you what's wrong.
                            </li>
                        </ol>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Mojang Login</h3>
                </div>
                <div class="panel-body">
                    @if($errors->has('mcError'))
                        <div class="alert alert-danger" role="alert">
                            <p>{{ $errors->first('mcError') }}</p>
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('mojang::postLogin') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @include('includes.ad')
        </div>
    </div>
</div>
@endsection
