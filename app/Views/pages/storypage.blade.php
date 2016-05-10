<?php
$texts = App\Story::all();
?>
@extends('layouts.master')
@section('content')
    <div class="row">
        <h1 class="entry-title">Verhalen: </h1>
    </div>
    <div class="col-xs-12">
        <div class="form-group label-placeholder is-empty">
            <label for="search" class="control-label">Zoeken</label>
            <input type="text" autocomplete="off" class="form-control" id="search">
        </div>
    </div>
    @foreach($texts as $text)
        <div class="row searchable">
            <h2 class="entry-title title">{{ $text->naam }}</h2>
            <div class="textarea text"> {!! $text->verhaal !!} </div>
            <hr/>
        </div>
    @endforeach
@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset('js/storysearcher.js') }}"></script>
@stop