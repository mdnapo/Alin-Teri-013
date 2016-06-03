@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <a href="{{ URL::previous() }}">
                <button class="btn btn-primary">Terug</button>
            </a>
        </div>
        <div class="col-xs-12">
            <h1>{{ $publication->source }}</h1>
            <div>
                {!! $publication->article !!}
            </div>
        </div>
        <div class="col-xs-12 top_buffer">
            @if(count($publication->comments) > 0)
                <h1>Reacties</h1>
                <div class="scroller bottom_buffer">
                    @foreach($publication->comments as $comment)
                        <div>{{ $comment->reactie }}</div>
                        <div>{{ $comment->reactie }}</div>
                        <div>{{ $comment->reactie }}</div>
                        <div>{{ $comment->reactie }}</div>
                    @endforeach
                </div>
            @else
                <h2>Nog geen reacties</h2>

            @endif
        </div>
    </div>
@stop

@section('footer')
    <script src="{{ asset('js/fluidvids.js') }}"></script>
    <script src="{{ asset('js/jquery.highlight.js') }}"></script>
    <script>
        $(document).ready(function () {
//            $('.collapse.publication').show();
//            $('img').addClass('img-responsive');
//            fluidvids.init({
//                selector: ['iframe'],
//                players: ['www.youtube.com', 'player.vimeo.com'] // players to support
//            })
        });
    </script>
@stop
