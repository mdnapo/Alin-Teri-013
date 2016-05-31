<?php
$pages = App\Story::all();
?>
@extends('layouts.admindashboard')
@section('adminPanel')
    <div class="col-xs-12">
        @if(count($errors) > 0)
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="well well-lg form-horizontal" method="POST" target="./create">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <fieldset>
                <legend>VERHAAL AANMAKEN</legend>
                <div class="form-group">
                    <label class="control-label" for="name">Naam</label>
                    <input type="text" class="form-control" id="name" name="naam">
                    <span class="material-input"></span>
                <span class="help-block">
                    Voer de naam van het verhaal in
                </span>
                </div>
                <div class="form-group">
                    <label class="control-label" for="name">Verhaal</label>
                    <textarea type="text" class="form-control" id="story" name="verhaal"></textarea>
                </div>
                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <a href="{{ url('/admin/stories/') }}" class="btn btn-primary">Cancel</a>
                        <input type="submit" class="btn btn-primary" value="Aanmaken"/>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
@endsection