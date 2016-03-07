@extends('layouts.master')
@section('content')
    <br />0
    <form method="POST" action="./login" novalidate>
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="form-group">
            <label >Gebruikersnaam</label>
            <input type="text" id="username" class="form-control" name="username" placeholder="Gebruikersnaam" >
        </div>
        <div class="form-group">
            <label >Wachtwoord</label>
            <input type="password" id="password" class="form-control" name="password" placeholder="Wachtwoord" >
            <input type="checkbox" name="remember">Remember me<br>
        </div>
        <div class="form-group">
            <button type="submit">Login</button>
        </div>
    </form>
@stop