@extends('layouts.app')

@section('breadcrumb')
<li><a href="{{ route('developer::dashboard') }}">Dashboard</a></li>
<li class="active">Create New Project</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Create New Project</div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('developer::project::createProject') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                            <label for="website" class="col-md-4 control-label">Project Website</label>

                            <div class="col-md-6">
                                <input id="website" type="url" class="form-control" name="website" value="{{ old('website') }}" required>

                                @if ($errors->has('website'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create Project
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
                        Creating A Project
                    </h3>
                </div>
                <div class="panel-body">
                    <p>
                        Welcome to the project creation screen {{ Auth::user()->name }}.
                    </p>
                    <p>
                        It's pretty simple and straight-forward. Just put in your client/project name, put in a website, click "Create Project," and badabing badaboom your project is ready for some sexy capes.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
