@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h2><strong>In de media</strong></h2>
        </div>
        <div class="col-xs-12">
            <div class="input-group">
                <input id="needle" type="text" class="form-control" placeholder="Zoeken naar...">
                <span class="input-group-btn">
                    <button id="search" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button>
                </span>
            </div>
        </div>
        <div class="col-xs-12">
            <button id="collapse_button" class="btn btn-primary">Alles openklappen</button>
        </div>
        <div id="publications_holder">
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
                            <div id="publication{{ $publication->id }}" class="panel-collapse collapse in publication">
                                <div class="panel-body">
                                    <div class="col-xs-12">{!! $publication->article !!}</div>
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
                    $(this).html('Alles openklappen');
                    $('.collapse.publication').collapse('hide').addClass('collapsed');
                    $('.collapse_publication').removeClass('glyphicon-chevron-up').
                            addClass('glyphicon-chevron-down');
                }
                else{
                    $(this).addClass('collapse_all');
                    $(this).html('Alles dichtklappen');
                    $('.collapse.publication').collapse('show').removeClass('collapsed');
                    $('.collapse_publication').removeClass('glyphicon-chevron-down').
                            addClass('glyphicon-chevron-up');
                }
            });
            $('#search').click(function(){
                $.ajax({
                    url: '{{ url('media-search') }}',
                    type: 'POST',
                    data: { _token: '{{ csrf_token() }}', needle: $('#needle').val() },
                    success: function(data){
                        $('#publications_holder').replaceWith(data);
                        $('.collapse.publication').collapse();
                        fluidvids.init({
                            selector: ['iframe'],
                            players: ['www.youtube.com', 'player.vimeo.com'] // players to support
                        });
                    }
                });
            });
            $('.collapse.publication').collapse();
            $('img').addClass('img-responsive');
            fluidvids.init({
                selector: ['iframe'],
                players: ['www.youtube.com', 'player.vimeo.com'] // players to support
            });
        });
    </script>
@stop