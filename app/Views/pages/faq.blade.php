@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h1>Frequently Asked Questions</h1>
        </div>
    </div>
    @foreach($cats as $cat)
        <h3>{{ $cat->name }}</h3>
        <div class="row">
            @foreach($cat->faqs as $faq)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $faq->question }}</div>
                        <div class="panel-body">{{ $faq->answer }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection