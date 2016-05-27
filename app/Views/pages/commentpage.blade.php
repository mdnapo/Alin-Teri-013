@extends('layouts.master')
@section('content')
    <div class="col-xs-12">
        <h1 class="entry-title">Een reactie plaatsen</h1>
        <form method="POST" action="./comment" class="well well-lg" >
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
            <input type="hidden" name="media_id" value="{{ $id }}" />
            <label class="control-label" for="email">Naam</label>
            <input type="name" class="form-control" name="name">
            <label class="control-label" for="bericht">Reactie</label>
            <textarea type="comment" class="form-control" name="comment"></textarea>
            <input type="submit" class="btn btn-primary" value="Versturen" />
        </form>
    </div>

    <div class="col-xs-12">
        <h1 class="entry-title">Geplaatste reacties</h1>
        <div class="form-group label-placeholder is-empty">
            <label for="search" class="control-label">Zoeken</label>
            <input type="text" autocomplete="off" class="form-control" id="search">
        </div>
    </div>

    @foreach($comments as $comment)
        <div class="col-xs-12 searchable">
            <h4 class="entry-title title">{{ $comment->naam }}:</h4>
            <div class="textarea text"> {!! $comment->reactie !!} </div>
            <hr/>
        </div>
    @endforeach

    <div class="col-xs-12">
        <div class="text-center">
            {{ $comments->render() }}
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript" src="{{ asset('js/storysearcher.js') }}"></script>
@stop