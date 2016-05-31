@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <h1>Verhalen</h1>
        </div>
        <div class="col-xs-12">
            <input id="needle" name="needle" type="text" class="form-control" placeholder="Zoeken naar..."
                   value="{{ isset($needle) ? $needle : '' }}">
        </div>
        <div class="col-xs-12">
            <button id="collapse_button" class="btn btn-primary">Alles openklappen</button>
        </div>
        <div id="stories_holder">
            <div class="col-xs-12">
                @if(count($stories) > 0)
                    @foreach($stories as $story)
                        <div class="panel panel-primary">
                            <div class="panel-heading collapse_publication" id="{{ $story->id }}">
                                {{ $story->naam }}
                                <span id="glyph{{ $story->id }}"
                                      class="glyphicon glyphicon-chevron-down pull-right glyph"
                                      data-toggle="collapse" href="#story{{ $story->id }}">
                                </span>
                            </div>
                            <div id="story{{ $story->id }}" class="panel-collapse collapse in story">
                                <div class="panel-body">
                                    <div class="col-xs-12">{!! $story->verhaal !!}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @elseif(isset($needle) && $needle != '')
                    <h3>Geen verhalen gevonden voor de term '{{ $needle }}'.</h3>
                @else
                    <h3>Nog geen verhalen.</h3>
                @endif
            </div>

            <!--Pagination-->
            <div class="col-xs-12">
                <div class="text-center">
                    {!! isset($needle) ? $stories->appends(['needle' => $needle])->render() : $stories->render() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script src="{{ asset('js/jquery.highlight.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).delegate('.collapse_publication', 'click', function () {
                var id = $(this).attr('id');
                var story = $('div#story' + id);
                var collapse_span = $(this).find('#glyph' + id);
                if (collapse_span.hasClass('glyphicon-chevron-up'))
                    collapse_span.removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
                else
                    collapse_span.removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
                story.collapse('toggle');
            });
            $('#collapse_button').click(function () {
                if ($(this).hasClass('collapse_all')) {
                    $(this).removeClass('collapse_all');
                    $(this).html('Alles openklappen');
                    $('.collapse.story').collapse('hide');
                    $('.collapse_publication').find('.glyph').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
                }
                else {
                    $(this).addClass('collapse_all');
                    $(this).html('Alles dichtklappen');
                    $('.collapse.story').collapse('show');
                    $('.collapse_publication').find('.glyph').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
                }
            });
            $('#needle').on('input', function () {
                var needle = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '{{ url('zoeken-in-verhalen') }}',
                    data: {needle: needle},
                    success: function (data) {
                        $('#stories_holder').replaceWith(data);
                        $('.collapse.story').collapse();
                        $('#stories_holder').highlight(needle);
                    }
                });
            });
            if ($('#needle').val() != '')
                $('#stories_holder').highlight($('#needle').val());
            $('.collapse.story').collapse();
            $('img').addClass('img-responsive');
        });
    </script>
@stop
