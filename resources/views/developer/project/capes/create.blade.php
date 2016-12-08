@extends('layouts.app')

@section('breadcrumb')
<li><a href="{{ route('developer::dashboard') }}">Dashboard</a></li>
<li><a href="{{ route('developer::project::capes', ['hash' => $project->hash]) }}">{{ $project->name }}</a></li>
<li class="active">Create New Cape</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Create New Cape</div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" id="createCapeForm" role="form" method="POST" enctype="multipart/form-data" action="{{ route('developer::project::createCape', ['hash' => $hash]) }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Cape Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('cape-template') ? ' has-error' : '' }}">
                            <label for="cape-template" class="col-md-4 control-label">Cape Template Upload</label>

                            <div class="col-md-6">
                                <input id="cape-template" type="file" name="cape-template">
                                {{-- <label class="btn btn-info btn-file">
                                    Browse for Cape PNG <input id="cape-template" type="file" name="cape-template" style="display: none;">
                                </label> --}}

                                @if ($errors->has('cape-template'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cape-template') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" id="createCapeButton" class="btn btn-primary" onclick="document.getElementById('createCapeButton').setAttribute('disabled', 'disabled');
                                                                                                             document.getElementById('createCapeForm').submit();">
                                    Create Cape
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Creating A Cape
                    </h3>
                </div>
                <div class="panel-body">
                    <p>
                        Welcome to the cape creation screen {{ Auth::user()->name }}.
                    </p>
                    <p>
                        Just name your cape, select your cape PNG, and click "Create Cape". There you go! You just created a cape!
                        <br/>
                        It's probably a good idea to follow our cape creation guidelines <a href"http://docs.halfpetal.com/CapesAPI/Creating-Capes"
                        target="_blank">here</a> to make sure every cape looks similar across clients.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
