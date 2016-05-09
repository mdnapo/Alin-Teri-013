@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h2><strong>In de media</strong></h2>
        </div>
        <div class="col-xs-12">
            @if(!$publications)
                @foreach($publications as $publication)
                    <div class="panel panel-primary">
                        <div class="panel-heading"> {{ $publication->source }} </div>
                        <div class="panel-body">
                            {{ $publication->article }}
                            <div> {{ $publication->video }} </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h3>Nog geen media publicaties</h3>
            @endif
        </div>
    </div>
@endsection