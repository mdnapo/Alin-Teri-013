@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h1>Frequently Asked Questions</h1>
            <a href="{{ url("/contact") }}">Staat uw vraag niet in deze lijst? Klik dan hier om naar de contactpagina
                te gaan om uw vraag te stellen!</a>
            <div class="form-group label-placeholder is-empty">
                <label for="search" class="control-label">Zoeken</label>
                <input type="text" autocomplete="off" class="form-control" id="search">
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($cats as $cat)
            <div class="category">
                <h3>{{ $cat->name }}</h3>
                <div class="row">
                    @foreach($cat->faqs as $faq)
                        <div class="
                    {{ ($settings->where('name', 'Rijen - PC')->first()->value == 4) ? 'col-md-3':'col-md-4' }}
                        {{ ($settings->where('name', 'Rijen - Tablet')->first()->value == 3) ? 'col-sm-4':'col-sm-6' }}
                        {{ ($settings->where('name', 'Rijen - Telefoon')->first()->value == 2) ? 'col-xs-6':'col-xs-12' }}
                                searchable">
                            <div class="panel panel-default faq" id="faq-{{ $faq->id }}">
                                <div class="panel-heading question">{{ $faq->question }}</div>
                                <div class="panel-body answer">{{ $faq->answer }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('footer')
    <script type="text/javascript" src="{{ asset('js/faqsearcher.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/resizer.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootbox.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
            $('.faq').on('click', function(e) {
                bootbox.alert(e.currentTarget.children[1].textContent);
                e.stopPropagation();
            });
        });
    </script>
@endsection
