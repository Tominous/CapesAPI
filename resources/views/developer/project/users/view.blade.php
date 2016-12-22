@extends('layouts.app')

@section('breadcrumb')
<li><a href="{{ route('developer::dashboard') }}">Dashboard</a></li>
<li><a href="{{ route('developer::project::capes', ['hash' => $project->hash]) }}">{{ $project->name }}</a></li>
<li><a href="{{ route('developer::project::capes', ['hash' => $project->hash]) }}">{{ $cape->name }}</a></li>
<li class="active">Users</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">{{ $cape->name }} Users</div>
                </div>
                <div class="panel-body">
                @if(count($users) > 0)
                    <br/>
                    @foreach($users as $user)
                        <div class="row vcenter">
                            <div class="col-md-2">
                                <img src="https://mc-heads.net/head/{{ $user->uuid }}" class="img-responsive" />
                            </div>
                            <div class="col-md-6">
                                <h4>{{ $user->name }} {{-- ({{ $user->uuid }}) --}}</h4>
                            </div>
                            <div class="col-md-2">
                                <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#{{ $user->uuid }}DeleteModal" title="Delete User"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="modal fade" id="{{ $user->uuid }}DeleteModal" tabindex="-1" role="dialog" aria-labelledby="removeUser">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="removeUser">Are you sure?</h4>
                                    </div>
                                    <div class="modal-body">
                                        You're about to take away the cape from {{ $user->name }} with the UUID of <code> {{ $user->uuid }} </code>.</br>
                                        Are you sure you want to do this?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a second...</button>
                                        <button type="button" class="btn btn-danger" 
                                            onclick="event.preventDefault();
                                                        document.getElementById('delete-user-{{ $user->uuid }}').submit();">
                                            Yes I'm sure.
                                        </button>

                                        <form id="delete-user-{{ $user->uuid }}" action="{{ route('developer::project::removeCapeUser', ['hash' => $project->hash, 'capeHash' => $cape->hash]) }}" method="POST" style="display:none;">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <input type="text" name="uuid" style="display: none;" value="{{ $user->uuid }}" required>
                                        </form>
                                    </div>
                                </div>
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
                    <h4>It looks like you don't have any users using your cape. <i class="fa fa-frown-o" aria-hidden="true"></i></h4>
                @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        {{ $cape->name }}
                    </h3>
                </div>
                <div class="panel-body">
                    <p>
                        Welcome to the users manager. Here you can manage what users have access to the cape.
                    </p>
                    <p>
                        If this page takes a minute to load, please bear with us. The Mojang API may be throttling us or may be offline.<br/>
                        If the name isn't parsed as a username (so it's a UUID), that means the Mojang API couldn't retrieve the name.
                    </p>
                    <hr/>
                    <p>
                        <h4>Add User</h4>
                        <form class="form-inline" role="form" action="{{ route('developer::project::addCapeUser', ['hash' => $project->hash, 'capeHash' => $cape->hash]) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="notch">
                            </div>
                            <button type="submit" class="btn btn-info">Add User</button>
                        </form>
                    </p>
                </div>
            </div>
            
            @include('includes.ad')
        </div>
    </div>
</div>
@endsection
