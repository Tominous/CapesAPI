@extends('layouts.app')

@section('breadcrumb')
<li><a href="{{ route('admin::dashboard') }}">Administration Panel</a></li>
<li class="active">All Developers</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">All Developers</h3>
                </div>
                <div class="panel-body">
                @if(count($users) > 0)
                    @foreach($users as $user)
                        @php
                            $user = User::where('id', $user->user_id)->first();
                        @endphp

                        <div class="row vcenter">
                            <div class="col-md-12">
                                <h4>{{ $user->name }} <span class="badge">{{ $user->email }}</span> <small>Registered {{ Carbon::parse($user->created_at)->diffForHumans() }}</h4>
                            </div>
                        </div>

                        @if(!$loop->last)
                        <hr/>
                        @endif
                    @endforeach
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                @else
                    <h4>No users are currently verified.</h4>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
