<?php
$items = App\Page::all();
?>

@extends('layouts.admindashboard')
@section('adminPanel')
    <table class="table table-bordered" >
        <thead>
            <th>#</th>
            <th>Naam</th>
            <th>Link</th>
            <th>Aanpassen</th>
            <th>Zichtbaar</th>
            <th>Verwijderen</th>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <th scope="row" class="#{{ $item->id }}">{{ $item->id }}</th>
                <td>{{ $item->name }}</td>
                <td>{{ $item->route }}</td>
                <td>
                    <a href="{{ url('/admin/pages/edit/'.$item->id) }}" class="glyphicon glyphicon-pencil"></a>
                </td>
                <td>
                    @if($item->active == 1)
                        <a href="{{ url('/admin/pages/visibility/'.$item->id.'/0') }}" class="glyphicon glyphicon-eye-close"></a>
                    @else
                        <a href="{{ url('/admin/pages/visibility/'.$item->id.'/1') }}" class="glyphicon glyphicon-eye-open"></a>
                    @endif
                </td>
                <td>
                    <a href="{{ url('/admin/pages/delete/'.$item->id) }}" class="glyphicon glyphicon-remove"></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="btn btn-raised">
        <a href="{{ url('/admin/pages/create') }}">Toevoegen</a>
    </div>

@endsection