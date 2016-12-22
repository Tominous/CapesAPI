@extends('layouts.app')

@section('breadcrumb')
<li class="active">Dashboard</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Welcome to CapesAPI</h3>
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
                    <p>
                        <a href="{{ route('developer::project::showCreateProject') }}" type="button" class="btn btn-info">Create New Project</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">My Projects</h3>
                </div>
                <div class="panel-body">
                @if(count($projects) > 0)
                    @foreach($projects as $project)
                        <div class="row">
                            <div class="col-md-8 col-md-offset-1">
                                <h4>{{ $project->name }} <span class="badge">{{ Capes::where('project_id', $project->id)->count() }} Capes</span></h4>
                            </div>
                            <div class="col-md-2">
                                <a type="button" href="{{ route('developer::project::capes', ['hash' => $project->hash]) }}" class="btn btn-primary">View Project</a>
                            </div>
                        </div>
                        @if(!$loop->last)
                        <hr/>
                        @endif
                    @endforeach
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            {{ $projects->links() }}
                        </div>
                    </div>
                @else
                    <h4>Awe. <i class="fa fa-frown-o" aria-hidden="true"></i> It looks like you don't have any projects yet. Why don't you <a href="{{ route('developer::project::showCreateProject') }}">create one</a>?</h4>
                @endif
                </div>
            </div>
            @include('includes.ad')
        </div>
    </div>
</div>
@endsection
