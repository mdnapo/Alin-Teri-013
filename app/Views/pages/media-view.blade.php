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
            <div>{!! $publication->article !!}</div>
        </div>
        @if($publication->video)
            <div class="col-xs-12 top_buffer">{!! $publication->video !!}</div>
        @endif
        <div class="col-xs-12 top_buffer">
            @if(count($publication->approvedComments) > 0)
                <h1>Reacties</h1>
                <div class="scroller bottom_buffer">
                    <div class="comment">
                        @foreach($publication->approvedComments as $comment)
                            @if($comment->geaccepteerd == 1)
                                <h4>{{ $comment->naam }}</h4>
                                <div>{{ $comment->reactie }}</div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @else
                <h2>Nog geen reacties</h2>
            @endif
        </div>
        <div class="col-xs-12">
            <h1 class="entry-title">Een reactie plaatsen</h1>
            <form method="POST" action="{{ url('comment') }}" class="well well-lg" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                <input type="hidden" name="publication_id" value="{{ $publication->id }}" />
                <label class="control-label" for="email">Naam</label>
                <input type="name" class="form-control" name="name">
                <label class="control-label" for="bericht">Reactie</label>
                <textarea type="comment" class="form-control" name="comment"></textarea>
                <input type="submit" class="btn btn-primary" value="Versturen"/>
            </form>
        </div>
    </div>
@stop

@section('footer')
    <script src="{{ asset('js/fluidvids.js') }}"></script>
    <script src="{{ asset('js/jquery.highlight.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('iframe').addClass('embed-responsive-item');
            $('img').addClass('img-responsive');
            fluidvids.init({
                selector: ['iframe'],
                players: ['www.youtube.com', 'player.vimeo.com'] // players to support
            })

        });
    </script>
@stop
