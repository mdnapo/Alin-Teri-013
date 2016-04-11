@extends('layouts.admindashboard')
@section('adminPanel')
    <h1>Dashboard</h1>
    <p>Welkom {{ Auth::user()->name }}, op het AlinTeri administratiepaneel.</p>
@endsection