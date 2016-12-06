@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1>We're Live</h1>
        <p>
            That's right, Capes API is live! For now we'll be manually verifying all the developers to help control the amount of calls made to our
            servers to help us determine our future updates.

            <h2>Donation Goal <small>$0/$250</small></h2>
            <div class="progress progress-striped active">
            <div class="progress-bar" style="width: 0%"></div>
            </div>
        </p>
        <p>
            <a href="{{ route('donate') }}" class="btn btn-success">Support Capes API</a>
            <a href="{{ route('mojang::getLogin') }}" class="btn btn-primary">User Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Developer Registration</a>
        </p>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Some Statistics</h3>
                </div>
                <div class="panel-body">
                    <h4>Total Registered Users <span class="badge">{{ User::count() }}</span></h4>
                    <h4>Total Projects <span class="badge">{{ Projects::count() }}</span></h4>
                    <h4>Total Capes <span class="badge">{{ Capes::count() }}</span></h4>
                    <h4>Total Capes Active <span class="badge">{{ ActiveCapes::where('active', true)->count() }}</span></h4>
                    <h4>Total Capes Given <span class="badge">{{ ActiveCapes::count() }}</span></h4>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="alert alert-warning">
                <strong>Attention!</strong> CapesAPI is in beta and therefore may be unstable at times.
                If you have any issues please email us <a href="http://www.google.com/recaptcha/mailhide/d?k=01VVUrD_7L5zAo1XiPALsJMQ==&amp;c=ThIU2EkSlNUvI0DWq6theIwKkwDd1SLCLrEaF6LvnAE=" onclick="window.open('http://www.google.com/recaptcha/mailhide/d?k\x3d01VVUrD_7L5zAo1XiPALsJMQ\x3d\x3d\x26c\x3dThIU2EkSlNUvI0DWq6theIwKkwDd1SLCLrEaF6LvnAE\x3d', '', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300'); return false;" title="Reveal this e-mail address">h...@halfpetal.com</a>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">About CapesAPI</h3>
                </div>
                <div class="panel-body">
                    <p>Capes API is a product created by Halfpetal and the WiZARDHAX crew for Minecraft hacked client developers.</p>
                    <p>
                        The issue we've seen is that every client has a cape, but you have to be on that client to see that cape. We're hoping
                        to help resolve that issue by giving developers a central location to store their cape data along with managing the users
                        that use their capes.
                    </p>
                    <p>
                        Also, it gives your users the ability to log in and select which cape they want to use.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
