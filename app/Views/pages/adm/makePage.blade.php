<?php
$pages = App\Page::all();
?>
@extends('layouts.admindashboard')
@section('adminPanel')
    <form class="well well-lg form-horizontal" method="POST" target="/create">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
        <fieldset>
            <legend>PAGINA AANMAKEN</legend>
            <div class="form-group">
                <label class="control-label" for="name">Naam</label>
                <input type="text" class="form-control" id="name" name="name">
                <span class="material-input"></span>
                <span class="help-block">
                    Geef een naam in van het menu item, zoals bijvoorbeeld donaties.
                </span>
            </div>
            <div class="form-group">
                <label for="parent" class="control-label"> Ouder: </label>
                <div class="">
                    <select id="parent" class="form-control" name="parent">
                        <option value="">Geen</option>
                        @foreach($pages as $page)
                            <option value="{{ $page->id }}">{{ $page->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label" for="route">Route</label>
                <input type="text" class="form-control" id="route" name="route">
                <span class="material-input"></span>
                <span class="help-block">
                    Bijvoorbeeld "Help-Ons"
                </span>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="active">
                    <span class="checkbox-material"> Actief</span>
                </label>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <a href="{{ url('/admin/dashboard') }}" class="btn btn-default">Cancel</a>
                    <input type="submit" class="btn btn-default" value="Aanmaken" />
                </div>
            </div>
        </fieldset>
    </form>
@endsection