@extends('layouts.app')

@section('breadcrumb')
<li class="active">Cape Dashboard</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Capes Dashboard</h3>
                </div>
                <div class="panel-body">
                    <p>
                        Welcome {{ Session::get('mojangUsername') }} to your capes dashboard.
                    </p>
                    <hr/>
                    <p>
                        <h4>Currently Active Cape</h4>
                        @php 
                            $activeCapeRecord = ActiveCapes::where(['uuid' => Session::get('mojangUUID'), 'active' => true])->first();
                            if($activeCapeRecord != null) {
                                $activeCape = Capes::where('hash', $activeCapeRecord->cape_hash)->first();
                                $activeProject = Projects::where('id', $activeCape->project_id)->first();
                                $activeDeveloper = User::where('id', $activeProject->developer_id)->first();
                            }
                        @endphp
                        @if($activeCapeRecord == null)
                            You have no active cape.
                        @else
                            {{ $activeCape->name }} <small>by {{ $activeDeveloper->name }} from {{ $activeProject->name }}</small>
                            <br/><br/>
                            <a type="button" class="btn btn-sm btn-danger" title="Disable All Capes" 
                                onclick="event.preventDefault();
                                            document.getElementById('disable-all-capes').submit();">
                                Disable All Capes</a>
                            <form id="disable-all-capes" action="{{ route('mojang::disableAllCapes') }}" method="POST" style="display: none;">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                            </form>
                        @endif
                    </p>
                    
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Cape Manager</h3>
                </div>
                <div class="panel-body">
                @if(count($capes))
                @foreach($capes as $cape)
                    @php 
                        $cape = Capes::where('hash', $cape->cape_hash)->first();
                        $project = Projects::where('id', $cape->project_id)->first();
                        $developer = User::where('id', $project->developer_id)->first();
                    @endphp
                    <div class="row vcenter">
                        <div class="col-md-8 col-md-offset-1">
                            <h4>{{ $cape->name }} <small>by {{ $developer->name }} from <a href="{{ $project->website }}" target="_blank">{{ $project->name }}</a></small></h4>
                        </div>
                        <div class="col-md-2">
                            <a type="button" class="btn btn-sm btn-primary" title="Make Cape Active" 
                                onclick="event.preventDefault();
                                         document.getElementById('set-cape-active-{{ $cape->hash }}').submit();">
                                Set Active</a>
                            <form id="set-cape-active-{{ $cape->hash }}" action="{{ route('mojang::putCapeActive') }}" method="POST" style="display: none;">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                                <input value="{{ $cape->hash }}" id="capeHash" name="capeHash" />
                            </form>
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
                @else
                    <h4>
                        Awe. <i class="fa fa-frown-o" aria-hidden="true"></i>
                        <br/>
                        It looks like you don't have any capes that are inactive. 
                    </h4>
                @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    @include('includes.ad')
                </div>
                <div class="col-md-6">
                    @include('includes.ad')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
