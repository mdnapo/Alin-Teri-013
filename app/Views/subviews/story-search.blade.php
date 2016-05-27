<div id="stories_holder">
    <div class="col-xs-12">
        @if(count($stories) > 0)
            @foreach($stories as $story)
                <div class="panel panel-primary">
                    <div class="panel-heading collapse_publication" id="{{ $story->id }}">
                        {{ $story->naam }}
                        <span id="glyph{{ $story->id }}" class="glyphicon glyphicon-chevron-down pull-right glyph"
                              data-toggle="collapse" href="#story{{ $story->id }}">
                                </span>
                    </div>
                    <div id="story{{ $story->id }}" class="panel-collapse collapse in publication">
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