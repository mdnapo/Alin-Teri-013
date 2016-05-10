@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h2><strong>In de media</strong></h2>
        </div>
        <div class="col-xs-12">
            <button id="collapse_button" class="btn btn-primary">Alles openklappen</button>
        </div>
        <div class="col-xs-12">
            @if(count($publications) > 0)
                @foreach($publications as $publication)
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            {{ $publication->source }}
                            <span id="{{ $publication->id }}" class="glyphicon glyphicon-chevron-down pull-right collapse_publication"
                                  data-toggle="collapse" href="#publication{{ $publication->id }}">
                            </span>
                        </div>
                        <div id="publication{{ $publication->id }}" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="col-xs-12 iframe_holder">{!! $publication->article !!}</div>
                                @if($publication->video != '')
                                    <div class="col-xs-12 text-center top_buffer"> {!! $publication->video !!} </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h3>Nog geen media publicaties</h3>
            @endif
        </div>

        <!--Pagination-->
        <div class="col-xs-12">
            <div class="text-center">
                {!! $publications->render() !!}
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script src="{{ asset('js/fluidvids.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.collapse_publication').click(function(){
                var id = $(this).attr('id');
                var publication = $('div#publication' + id);
                var collapse_span = $('span#' + id);
                if(!publication.hasClass('collapsed')){
                    publication.addClass('collapsed');
                    collapse_span.removeClass('glyphicon-chevron-up').
                            addClass('glyphicon-chevron-down');
                }
                else{
                    publication.removeClass('collapsed');
                    collapse_span.removeClass('glyphicon-chevron-down').
                            addClass('glyphicon-chevron-up');
                }
                publication.collapse('toggle');
            });
            $('#collapse_button').click(function(){
                if($(this).hasClass('collapse_all')){
                    $(this).removeClass('collapse_all');
                    $('#collapse_button').html('Alles openklappen');
                    $('.collapse').collapse('hide').addClass('collapsed');
                    $('.collapse_publication').removeClass('glyphicon-chevron-up').
                            addClass('glyphicon-chevron-down');
                }
                else{
                    $(this).addClass('collapse_all');
                    $("#collapse_button").html('Alles dichtklappen');
                    $('.collapse').collapse('show').removeClass('collapsed');
                    $('.collapse_publication').removeClass('glyphicon-chevron-down').
                            addClass('glyphicon-chevron-up');
                }
            });
            $('.collapse').collapse();
            $('img').addClass('img-responsive');
            fluidvids.init({
                selector: ['iframe'], // runs querySelectorAll()
                players: ['www.youtube.com', 'player.vimeo.com'] // players to support
            });
        });
    </script>
@stop