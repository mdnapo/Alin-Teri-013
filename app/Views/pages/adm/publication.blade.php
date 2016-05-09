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

    <form class="well well-lg form-horizontal" method="POST" target=".">
        <input type="hidden" name="_token" value="<?= csrf_token(); ?>" >
        <fieldset>
            <legend>MEDIA PUBLICATIE AANMAKEN</legend>
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

    <form id="delete" method="POST" action="{{ url('/admin/media/delete/' . $publication->id) }}">
        <input name="_token" value="{{ csrf_token() }}" hidden>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#delete_publication').click(function delete_publication(){
                bootbox.confirm('Weet u zeker dat u deze publicatie wilt verwijderen?', function(answer){
                    if(answer === true) $('#delete').submit();
                });
            });
        });
    </script>
@endsection