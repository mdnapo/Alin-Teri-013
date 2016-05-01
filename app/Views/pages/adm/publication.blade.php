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
                    Geef de publicatie bron op.
                </span>
            </div>
            <div class="form-group">
                <label class="control-label" for="artikel">Artikel</label>
                <textarea name="artikel">{{ old('artikel') != null ? old('artikel') : $publication->article }}</textarea>
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
                    <a href="{{ url('/admin/media') }}" class="btn btn-default">Cancel</a>
                    <input type="submit" class="btn btn-default" value="Aanmaken" />
                </div>
            </div>
        </fieldset>
    </form>
@endsection