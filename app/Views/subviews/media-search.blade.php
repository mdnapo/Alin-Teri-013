<div id="publications_holder">
    <div class="col-xs-12">
        @if(count($publications) > 0)
            @foreach($publications as $publication)
                <div class="panel panel-primary">
                    <div class="panel-heading collapse_publication" id="{{ $publication->id }}">
                        {{ $publication->source }}
                        <span id="glyph{{ $publication->id }}" class="glyphicon glyphicon-chevron-down pull-right glyph"
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