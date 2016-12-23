@extends('layouts.app')

@section('breadcrumb')
<li class="active">Administration Panel</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Welcome to the Administration Panel</h3>
                </div>
                <div class="panel-body">
                    <p>
                        Welcome {{ Auth::user()->name }} to your admin panel!
                    </p>
                    <p>
                        Please take care as you can ruin someone's client if you mess up. Especially if they didn't handle response status codes carefully.
                    </p>
                    <p>
                        The admin panel is a WIP. Please let me, Matthew, know if you want anything added to the panel. 
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Unverified Users</h3>
                </div>
                <div class="panel-body">
                @if(count($users) > 0)
                    @foreach($users as $user)
                        @php
                            $user = User::where('id', $user->user_id)->first();
                        @endphp

                        <div class="row vcenter">
                            <div class="col-md-7 col-md-offset-1">
                                <h4>{{ $user->name }} <span class="badge">{{ $user->email }}</span> <small>{{ Carbon::parse($user->created_at)->diffForHumans() }}</h4>
                            </div>
                            <div class="col-md-3">
                                <a type="button" class="btn btn-sm btn-primary" 
                                    onclick="event.preventDefault();
                                                document.getElementById('make-dev-form').submit();">
                                    Verify Dev
                                </a>
                                <a type="button" href="" class="btn btn-sm btn-danger" disabled="disabled">Ban User</a>

                                <form id="make-dev-form" action="{{ route('admin::makeDeveloper') }}" method="POST" style="display: none;">
                                    {{ method_field('POST') }}
                                    {{ csrf_field() }}
                                    <input type="text" value="{{ $user->email }}" name="user_email" id="user_email" />
                                </form>
                            </div>
                        </div>

                        @if(!$loop->last)
                        <hr/>
                        @endif
                    @endforeach
                @else
                    <h4>No users currently need verified. Go grab some coffee, take a break, and good job {{ Auth::user()->name }}!</h4>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
