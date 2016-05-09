@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h2><strong>In de media</strong></h2>
        </div>
        <div class="col-xs-12">
            @if(count($publications) > 0)
                @foreach($publications as $publication)
                    <div class="panel panel-primary">
                        <div class="panel-heading"> {{ $publication->source }} </div>
                        <div class="panel-body">
                            <div class="col-xs-12">{!! $publication->article !!}</div>
                            @if($publication->video != '')
                                <div class="col-xs-12 text-center top_buffer"> {!! $publication->video !!} </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <h3>Nog geen media publicaties</h3>
            @endif
        </div>
    </div>
@stop