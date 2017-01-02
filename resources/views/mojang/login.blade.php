@extends('layouts.app')

@section('breadcrumb')
<li class="active">Mojang Login</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Logging into Capes API</h3>
                </div>
                <div class="panel-body">
                    
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Mojang Login</h3>
                </div>
                <div class="panel-body">
                    @if($errors->has('mcError'))
                        <div class="alert alert-danger" role="alert">
                            <p>{{ $errors->first('mcError') }}</p>
                        </div>
                    @endif
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('mojang::postLogin') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('mcAuthCode') ? ' has-error' : '' }}">
                            <label for="mcAuthCode" class="col-md-4 control-label">Auth Code</label>

                            <div class="col-md-6">
                                <input id="mcAuthCode" type="text" class="form-control" name="mcAuthCode" value="{{ old('mcAuthCode') }}" required autofocus>

                                @if ($errors->has('mcAuthCode'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mcAuthCode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @include('includes.ad')
        </div>
    </div>
</div>
@endsection
