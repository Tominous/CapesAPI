@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    Welcome to CapesAPI
                </div>
                <div class="panel-body">
                    <p>
                        Welcome {{ Auth::user()->name }} to CapesAPI!
                    </p>
                    <p>
                        If you haven't checked it out yet, check out our <a href="{{ route('api-docs') }}" target="_blank">docs</a>
                        to get started with using CapesAPI.
                    </p>
                    <p>
                        Please note, CapesAPI is in beta and can be under heavy load from time to time. Please bear with us during any down time.
                    </p>
                    <p>
                        Also, if you don't mind. If you're enjoying the CapesAPI system, <a href="{{ route('donate') }}" target="_blank">
                        please consider donating</a> to keep our service free for all.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
        </div>
    </div>
</div>
@endsection
