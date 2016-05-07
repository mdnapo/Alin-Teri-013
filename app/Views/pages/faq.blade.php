@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h1>Frequently Asked Questions</h1>
        </div>
    </div>
    @foreach($cats as $cat)
        <div class="category">
            <h3>{{ $cat->name }}</h3>
            <div class="row">
                @foreach($cat->faqs as $faq)
                    <div class="
                    @if ($settings[0]->value == 2)
                            col-lg-6
                    @elseif($settings[0]->value == 3)
                            col-lg-4
                    @else
                            col-lg-3
                    @endif
                    {{ ($settings[1]->value == 3) ? 'col-md-4':'col-md-6' }}
                    {{ ($settings[2]->value == 2) ? 'col-sm-6':'col-sm-12' }}
                            searchable">
                        <div class="panel panel-default">
                            <div class="panel-heading question">{{ $faq->question }}</div>
                            <div class="panel-body answer">{{ $faq->answer }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
    <script src="{{ asset('js/searcher.js') }}"></script>
@endsection
