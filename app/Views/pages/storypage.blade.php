<?php
$texts = App\Story::all();
?>
@extends('layouts.master')
@section('content')
    <div class="row">
        <h1 class="entry-title">Verhalen: </h1>
    </div>
    @foreach($texts as $text)
        <div class="row">
            <h2 class="entry-title">{{ $text->naam }}</h2>
            <div class="textarea"> {!! $text->verhaal !!} </div>
            <hr/>
        </div>
    @endforeach
@endsection