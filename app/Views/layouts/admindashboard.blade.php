<?php
if(!App\User::isAdmin(Auth::user()->id)){
    return redirect('/');
}
?>
@extends('layouts.master')
@section('content')
    <div id="adm-pnl-left" class="col-xs-6 col-md-4">
        <div class="btn-group-vertical">
            <div class="btn btn-raised"><a href="{{ url('/admin/dashboard') }}" >DashBoard</a></div>
            <div class="btn btn-raised"><a href="{{ url('/admin/pages') }}">Pagina's</a></div>
            <div class="btn btn-raised"><a href="{{ url('/admin/newsletter') }}">Nieuwsbrief</a></div>
            <div class="btn btn-raised"><a href="{{ url('/admin/users') }}">Gebruikers</a></div>
        </div>
    </div>
    <div id="adm-pnl-right" class="col-xs-12 col-md-8">
        @yield('adminPanel')
    </div>
@stop