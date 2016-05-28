<div class="col-xs-12" id="comments_holder">
    <h1>Reacties</h1>

    @if(count($publication->comments) > 0)
        <table class="table table-bordered" >
            <thead>
            <th>#</th>
            <th>Naam</th>
            <th>Verhaal</th>
            <th>Gereageerd op</th>
            <th>Bekijken</th>
            <th>Accepteren</th>
            <th>Verwijderen</th>
            </thead>
            <tbody>
            @foreach($publication->comments as $comment)
                <tr>
                    <th scope="row" class="#{{ $comment->id }}">{{ $comment->id }}</th>
                    <td>{{ $comment->naam }}</td>
                    <td>
                        <input type="hidden" id="comment{{ $comment->id }}" value="{{ $comment->reactie }}">
                        {{
                            strlen($comment->reactie) < 40 ?
                            $comment->reactie:
                            substr($comment->reactie, 0, 40).'...'
                        }}
                    </td>
                    <td>{{ $comment->created_at }}</td>
                    <td>
                        <a id="{{ $comment->id }}" class="glyphicon glyphicon-zoom-in plain_link"></a>
                    </td>
                    <th>
                        @if($comment->geaccepteerd == 0)
                            <a id="{{ $comment->id }}" class="glyphicon glyphicon-ok-sign plain_link"></a>
                        @else
                            <span class="glyphicon glyphicon-check"></span>
                        @endif
                    </th>
                    <td>
                        <a id="{{ $comment->id }}" class="glyphicon glyphicon-remove plain_link"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h3>Nog geen reacties.</h3>
    @endif
</div>