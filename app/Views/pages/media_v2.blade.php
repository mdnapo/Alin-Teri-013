@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h1>In de media</h1>
        </div>
        <div class="col-xs-12">
            <input id="needle" name="needle" type="text" class="form-control" placeholder="Zoeken naar..."
                   value="{{ isset($needle) ? $needle : '' }}">
        </div>
        <div class="col-xs-12">
            <button id="collapse_button" class="btn btn-primary">Alles openklappen</button>
        </div>
        <div id="publications_holder">
            <div class="col-xs-12">
                @if(count($publications) > 0)
                    @foreach($publications as $publication)
                        <div class="panel panel-primary">
                            <div class="panel-heading collapse_publication" id="{{ $publication->id }}">
                                <a href="#" class="pop circle"></a>
                                {{ $publication->source }}
                                <span id="glyph{{ $publication->id }}"
                                      class="glyphicon glyphicon-chevron-down pull-right glyph"
                                      data-toggle="collapse" href="#publication{{ $publication->id }}">
                                </span>
                            </div>
                            <div id="publication{{ $publication->id }}" class="panel-collapse collapse in publication">
                                <div class="panel-body">
                                    <div class="col-xs-12">
                                        <a class="article_link" title="Lees meer...">
                                            {{ $teasers["$publication->id"].'.....' }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @elseif(isset($needle) && $needle != '')
                    <h3>Geen publicaties gevonden voor de term '{{ $needle }}'.</h3>
                @else
                    <h3>Nog geen media publicaties.</h3>
                @endif
            </div>

            <!--Pagination-->
            <div class="col-xs-12">
                <div class="text-center">
                    {!! isset($needle) ? $publications->appends(['needle' => $needle])->render() : $publications->render() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script src="{{ asset('js/fluidvids.js') }}"></script>
    <script src="{{ asset('js/jquery.highlight.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).delegate('.collapse_publication', 'click', function () {
                var id = $(this).attr('id');
                var publication = $('div#publication' + id);
                var collapse_span = $(this).find('#glyph' + id);
                if (collapse_span.hasClass('glyphicon-chevron-up'))
                    collapse_span.removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
                else
                    collapse_span.removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
                publication.collapse('toggle');
            });
            $('#collapse_button').click(function () {
                if ($(this).hasClass('collapse_all')) {
                    $(this).removeClass('collapse_all');
                    $(this).html('Alles openklappen');
                    $('.collapse.publication').collapse('hide');
                    $('.collapse_publication').find('.glyph').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
                }
                else {
                    $(this).addClass('collapse_all');
                    $(this).html('Alles dichtklappen');
                    $('.collapse.publication').collapse('show');
                    $('.collapse_publication').find('.glyph').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
                }
            });
            $('#needle').on('input', function () {
                var needle = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '{{ url('zoeken-in-media') }}',
                    data: {needle: needle},
                    success: function (data) {
                        $('#publications_holder').replaceWith(data);
                        $('.collapse.publication').collapse();
                        $('#publications_holder').highlight(needle);
                    }
                });
            });
            if ($('#needle').val() != '')
                $('#publications_holder').highlight($('#needle').val());
            $('.collapse.publication').collapse();
            $('img').addClass('img-responsive');
            fluidvids.init({
                selector: ['iframe'],
                players: ['www.youtube.com', 'player.vimeo.com'] // players to support
            })
        });
    </script>
@stop
