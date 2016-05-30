@extends('layouts.master')
@section('content')
    <div id="adm-pnl-left" class="col-sm-3 col-lg-2">
        <div class="btn-group-vertical">
            <div class="btn btn-raised"><a href="{{ url('/admin/dashboard') }}">dashboard</a></div>
            <div class="btn btn-raised"><a href="{{ url('/admin/pages') }}">pagina's</a></div>
            <div class="btn btn-raised"><a href="{{ url('/admin/stories') }}">verhalen</a></div>
            <div class="btn btn-raised"><a href="{{ url('/admin/newsletter') }}">nieuwsbrief</a></div>
            <div class="btn btn-raised"><a href="{{ url('/admin/mailinglist') }}">Mailinglist</a></div>
            <div class="btn btn-raised"><a href="{{ url('/admin/steun-ons') }}">steun ons</a></div>
            <div class="btn btn-raised"><a href="{{ url('/admin/media') }}">in de media</a></div>
            <div class="btn btn-raised"><a href="{{ url('/admin/contact') }}">contact</a></div>
            {{--<div class="btn btn-raised"><a href="{{ url('/admin/users') }}">gebruikers</a></div>--}}
            <div class="btn btn-raised"><a href="{{ url('/admin/faq') }}">f.a.q.</a></div>
            <div class="btn btn-raised"><a href="{{ url('/admin/settings') }}">settings</a></div>
        </div>
    </div>
    <div id="adm-pnl-right" class="col-xs-12 col-sm-9 col-lq-10">
        @yield('adminPanel')
    </div>
@stop
