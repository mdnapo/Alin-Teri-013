<?php
$items = App\Page::orderBy('sort')->get();
?>

@extends('layouts.admindashboard')
@section('adminPanel')
    <h1>Pagina's</h1>
    <table class="table table-bordered" >
        <thead>
            <th>#</th>
            <th>Naam</th>
            <th>Link</th>
            <th>Aanpassen</th>
            <th>Zichtbaar</th>
            <th>Sorteren</th>
            <th>Verwijderen</th>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <th scope="row" class="#{{ $item->id }}">{{ $item->id }}</th>
                <td>{{ $item->name }}</td>
                <td>{{ $item->route }}</td>
                <td>
                    <a href="{{ url('/admin/pages/edit/'.$item->id) }}" class="glyphicon glyphicon-pencil plain_link"></a>
                </td>
                <td>
                    @if($item->protected == 0)
                        @if($item->active == 1)
                            <a href="{{ url('/admin/pages/visibility/'.$item->id.'/0') }}" class="glyphicon glyphicon-eye-close plain_link"></a>
                        @else
                            <a href="{{ url('/admin/pages/visibility/'.$item->id.'/1') }}" class="glyphicon glyphicon-eye-open plain_link"></a>
                        @endif
                    @endif
                </td>
                <td>
                    @if($item->sort > 0)
                        <a href="{{ url('/admin/pages/move-up/'.$item->id) }}" class="glyphicon glyphicon-arrow-up plain_link"></a>
                    @endif
                    @if($item->sort < App\Page::orderBy('sort', 'DESC')->first()->sort)
                        <a href="{{ url('/admin/pages/move-down/'.$item->id) }}" class="glyphicon glyphicon-arrow-down plain_link"></a>
                    @endif
                </td>
                <td>
                    @if($item->protected == 0)
                        <a href="{{ url('/admin/pages/delete/'.$item->id) }}" class="glyphicon glyphicon-remove plain_link"></a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="btn btn-raised">
        <a href="{{ url('/admin/pages/create') }}">Toevoegen</a>
    </div>

@stop