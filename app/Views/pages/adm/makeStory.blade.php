<?php
$pages = App\Story::all();
?>
@extends('layouts.admindashboard')
@section('adminPanel')
    <form class="well well-lg form-horizontal" method="POST" target="/create">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <fieldset>
            <legend>VERHAAL AANMAKEN</legend>
            <div class="form-group">
                <label class="control-label" for="name">Naam</label>
                <input type="text" class="form-control" id="name" name="name">
                <span class="material-input"></span>
                <span class="help-block">
                    Voer de naam van het verhaal in
                </span>
            </div>
            <div class="form-group">
                <label class="control-label" for="name">Verhaal</label>
                <textarea type="text" class="form-control" id="story" name="story"></textarea>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <a href="{{ url('/admin/stories') }}" class="btn btn-default">Cancel</a>
                    <input type="submit" class="btn btn-default" value="Aanmaken"/>
                </div>
            </div>
        </fieldset>
    </form>
@endsection