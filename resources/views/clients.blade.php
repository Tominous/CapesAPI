@extends('layouts.app')

@section('head')
<link href="{{ asset('css/flexgrid.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="page-header">
        <h1>Clients with CapesAPI <small>Thanks everyone!</small></h1>
    </div>
    <div class="flex-grid-thirds">
        <div class="col">
            <div class="callout callout-primary">
                <h4><a href="https://liquidbounce.net/" target="_blank">Liquid Bounce</a></h4>
                By <a href="https://twitter.com/SenkJu" target="_blank">heafie</a> and <a href="https://twitter.com/SenkJu" target="_blank">Marco_MC</a>.
            </div>
        </div>

        <div class="col">
            <div class="callout callout-primary">
                <h4><a href="http://skillclient.tk/" target="_blank">Skill Client</a></h4>
                By <a href="https://twitter.com/MCmodding4k" target="_blank">MCmodding4k</a>.
            </div>
        </div>

        <div class="col">
            <div class="callout callout-primary">
                <h4><a href="http://question-client.weebly.com/" target="_blank">Question Client</a></h4>
                By <a href="https://twitter.com/pidgeon4life" target="_blank">QuestionDev</a>.
            </div>
        </div>
    </div>
</div>
@endsection