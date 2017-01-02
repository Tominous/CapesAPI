@extends('layouts.app')

@section('breadcrumb')
<li><a href="{{ route('developer::dashboard') }}">Dashboard</a></li>
<li class="active">{{ $project->name }}</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $project->name }} Control Panel</h3>
                </div>
                <div class="panel-body">
                    <h4>Information</h4>
                    Project ID: <code> {{ $project->hash }} </code><br/>
                    Created: {{ Carbon::parse($project->created_at)->toDayDateTimeString() }}<br/>
                    Capes: {{ Capes::where('project_id', $project->id)->count() }}<br/>
                    Website: <a href="{{ $project->website }}" target="_blank">{{ $project->website }}</a>
                    <br/><br/>
                    <a href="{{ route('developer::project::showCreateCape', ['hash' => $project->hash]) }}" type="button" class="btn btn-sm btn-success">Create Cape</a>
                    <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editProject">Edit Project</a>
                    <a type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteProject">Delete Project</a>
                </div>
            </div>
            
            @include('includes.ad')

            <div class="modal fade" id="editProject" tabindex="-1" role="dialog" aria-labelledby="editProject" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">{{ $project->name }}</h4>
                        </div>
                        <div class="modal-body">
                            <h4>Edit Project Information</h4>
                            <form class="form-horizontal" id="saveProject" role="form" action="{{ route('developer::project::editProject', ['hash' => $project->hash]) }}" method="POST">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Name</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ (old('name') !== null) ? old('name') : $project->name }}" required autofocus>

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
                                        <input id="website" type="url" class="form-control" name="website" value="{{ (old('website') !== null) ? old('website') : $project->website }}" required>

                                        @if ($errors->has('website'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('website') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success" 
                                onclick="event.preventDefault();
                                            document.getElementById('saveProject').submit();">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deleteProject" tabindex="-1" role="dialog" aria-labelledby="deleteProject">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
                        </div>
                        <div class="modal-body">
                            You're about to delete the project "{{ $project->name }}". Once you do this, all capes will be gone and this action <b>CAN NOT</b> be reversed.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Wait a second...</button>
                            <button type="button" class="btn btn-danger" 
                                onclick="event.preventDefault();
                                         document.getElementById('deleteProjectForm').submit();">
                                Yes I'm sure.
                            </button>

                            <form id="deleteProjectForm" action="{{ route('developer::project::deleteProject', ['hash' => $project->hash]) }}" method="POST" style="display:none;">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ $project->name }} Capes</h3>
                </div>
                <div class="panel-body">
                @if(!$capes->isEmpty())
                    <div class="container-fluid">
                    @foreach($capes as $cape)
                        <div class="row" style="margin-bottom:10px;">
                            <div class="col-md-2">
                                <img src="{{ asset('storage/' . Auth::user()->email . '/' . $project->hash . '/' . $cape->hash . '/cape.png') }}" class="img-responsive" alt="Cape Template" />
                            </div>
                            <div class="col-md-4">
                                <h4>{{ $cape->name }} <span class="badge">{{ ActiveCapes::where('cape_hash', $cape->hash)->count() }} Users</span></h4>
                            </div>
                            <div class="col-md-8" style="padding-top: 5px;">
                                <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#{{ $cape->hash }}InfoModal" title="View Cape Info"><i class="fa fa-info" aria-hidden="true"></i></a>
                                <a type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#{{ $cape->hash }}EditModal" title="Edit Cape"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a href="{{ route('developer::project::showCapeUsers', ['hash' => $project->hash, 'capeHash' => $cape->hash]) }}" type="button" class="btn btn-sm btn-primary" title="View/Edit Users"><i class="fa fa-users" aria-hidden="true"></i></a>
                                <a type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#{{ $cape->hash }}DeleteModal" title="Delete Cape"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="modal fade" id="{{ $cape->hash }}InfoModal" tabindex="-1" role="dialog" aria-labelledby="infoCape">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="infoCape">Cape Information</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h3>{{ $cape->name }} Information</h3>
                                        <h4>Cape ID: <code> {{ $cape->hash }} </code><br/></h4> 
                                        <h4>Users: {{ ActiveCapes::where('cape_hash', $cape->hash)->count() }} <br/></h4>
                                        <h4>Created: {{ Carbon::parse($cape->created_at)->toDayDateTimeString() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="{{ $cape->hash }}DeleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteCape">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="deleteCape">Are you sure?</h4>
                                    </div>
                                    <div class="modal-body">
                                        You're about to delete the cape "{{ $cape->name }}". That means no one will be able to use it, and it will 404 any calls to the cape and we will not be able to recover the files either. Are you absolutely sure?
                                        <br/><br/>
                                        <h3>Some Statistics</h3>
                                        Users: {{ ActiveCapes::where('cape_hash', $cape->hash)->count() }} <br/>
                                        Created: {{ Carbon::parse($cape->created_at)->toDayDateTimeString() }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Wait a second...</button>
                                        <button type="button" class="btn btn-danger" 
                                            onclick="event.preventDefault();
                                                     document.getElementById('delete-cape-{{ $cape->hash }}').submit();">
                                            Yes I'm sure.
                                        </button>

                                        <form id="delete-cape-{{ $cape->hash }}" action="{{ route('developer::project::deleteCape', ['hash' => $project->hash, 'capeHash' => $cape->hash]) }}" method="POST" style="display:none;">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="{{ $cape->hash }}EditModal" tabindex="-1" role="dialog" aria-labelledby="editCape">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="editCape">{{ $cape->name }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4>Edit Cape</h4>
                                        <form class="form-horizontal" id="edit-cape-{{ $cape->hash }}" role="form" action="{{ route('developer::project::editCape', ['hash' => $project->hash, 'capeHash' => $cape->hash]) }}" method="POST" enctype="multipart/form-data">
                                            {{ method_field('PUT') }}
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
                                                        Browse for Cape PNG <input id="cape-template" type="file" name="cape-template" style="display: none;" enctype="multipart/form-data">
                                                    </label> --}}

                                                    @if ($errors->has('cape-template'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('cape-template') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-success" 
                                            onclick="event.preventDefault();
                                                     document.getElementById('edit-cape-{{ $cape->hash }}').submit();">
                                            Save Cape
                                        </button>
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
                                {{ $capes->links() }}
                            </div>
                        </div>
                    </div>
                @else
                    <h4>Awe. <i class="fa fa-frown-o" aria-hidden="true"></i> It looks like you don't have any capes for your project yet. Why don't you <a href="{{ route('developer::project::showCreateCape', ['hash' => $project->hash]) }}">create one</a>?</h4>
                @endif
                </div>
            </div>
            
            @include('includes.ad')
        </div>
    </div>
</div>
@endsection
