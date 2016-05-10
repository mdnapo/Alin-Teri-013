<?php
$story = App\Story::where('id', $id)->firstOrFail();
?>
@extends('layouts.admindashboard')
@section('adminPanel')
    <form class="well well-lg form-horizontal" method="POST" target="/edit">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <fieldset>
            <legend>VERHALEN BEWERKEN</legend>
            <div class="form-group">
                <label class="control-label" for="name">Naam</label>
                <input type="text" class="form-control" id="naam" name="naam" value="{{ $story->naam }}">
                <span class="material-input"></span>
                <span class="help-block">
                    Voer de naam van het verhaal in
                </span>
            </div>
            <div class="form-group">
                <textarea name="verhaal">{{ $story->verhaal }}</textarea>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <a href="{{ url('/admin/stories') }}" class="btn btn-default">Annuleer</a>
                    <input type="submit" class="btn btn-default" value="Opslaan"/>
                </div>
            </div>
        </fieldset>
    </form>
@endsection