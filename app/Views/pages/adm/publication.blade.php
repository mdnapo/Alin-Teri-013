@extends('layouts.admindashboard')
@section('adminPanel')
    @if(count($errors) > 0)
        <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-xs-12">
        <form class="well well-lg form-horizontal" method="POST" target=".">
            <input type="hidden" name="_token" value="<?= csrf_token(); ?>" >
            <fieldset>
                <legend>MEDIA PUBLICATIE {{ $publication->id > 0 ? 'BEWERKEN' : 'AANMAKEN' }}</legend>
                <div class="form-group">
                    <label class="control-label" for="bron">Publicatie bron</label>
                    <input type="text" class="form-control" name="bron"
                           value="{{ old('bron') != null ? old('bron') : $publication->source }}" required>
                    <span class="material-input"></span>
                <span class="help-block">
                    Geef hier de publicatie bron op.
                </span>
                </div>
                <div class="form-group">
                    <label class="control-label" for="artikel">Artikel</label>
                    <textarea id="c" name="artikel">{{ old('artikel') != null ? old('artikel') : $publication->article }}</textarea>
                </div>
                <div class="form-group">
                    <label class="control-label" for="iframe">Video</label>
                    <input type="text" class="form-control" name="video" value="{{ old('video') != null ? old('video') : $publication->video }}">
                    <span class="material-input"></span>
                <span class="help-block">
                    Geef hier het iframe van de video op.
                </span>
                </div>
                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <a href="{{ url('/admin/media') }}" class="btn btn-primary">Terug</a>
                        @if($publication->id > 0)
                            <a id="delete_publication" class="btn btn-primary delete">Verwijderen</a>
                        @endif
                        <input type="submit" class="btn btn-primary" value="{{ $publication->id > 0 ? 'Opslaan' : 'Aanmaken' }}" />
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <form id="delete" method="POST" action="{{ url('/admin/media/delete/' . $publication->id) }}">
        <input name="_token" value="{{ csrf_token() }}" hidden>
    </form>


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
@stop

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.5.8/full/ckeditor.js"></script>
    <script>
        $(document).ready(function(){
            $('.glyphicon-zoom-in').click(function(){
                var id = $(this).attr('id');
                var message = $('#comment' + id).val();
                bootbox.dialog({
                    message: message,
                    buttons: {
                       success: {
                           label: 'Sluiten',
                           className: 'btn-primary'
                       }
                   }
                });
            });
            $(document).delegate('.glyphicon-remove', 'click', function(){
                var id = $(this).attr('id');
                bootbox.confirm('Weet u zeker dat u deze reactie wilt verwijderen?', function(answer){
                    if(answer === true){
                        $.ajax({
                            type: 'GET',
                            url: '{{ url('/admin/delete_comment') }}/' + id,
                            success: function(data){
                                $('#comments_holder').replaceWith(data);
                            }
                        })
                    }
                });
            });
            $(document).delegate('.glyphicon-ok-sign', 'click', function(){
                var id = $(this).attr('id');
                $.ajax({
                    type: 'GET',
                    url: '{{ url('/admin/accept_comment') }}/' + id,
                    success: function(data){
                        $('#comments_holder').replaceWith(data);
                    }
                });
            });
            $('#delete_publication').click(function(){
                bootbox.confirm('Weet u zeker dat u deze publicatie wilt verwijderen?', function(answer){
                    if(answer === true) $('#delete').submit();
                });
            });
            CKEDITOR.replace('c');
        });
    </script>
@stop
