<?php
$items = App\Story::all();
?>

@extends('layouts.admindashboard')
@section('adminPanel')
    <h1>Verhalen</h1>
    <table class="table table-bordered" >
        <thead>
            <th>#</th>
            <th>Naam</th>
            <th>Aanpassen</th>
            <th>Verwijderen</th>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <th scope="row" class="#{{ $item->id }}">{{ $item->id }}</th>
                <td>{{ $item->name }}</td>
                <td>
                    <a href="{{ url('/admin/stories/edit/'.$item->id) }}" class="glyphicon glyphicon-pencil"></a>
                </td>
                <td>
                    @if($item->route != "")
                        <a href="{{ url('/admin/stories/delete/'.$item->id) }}" class="glyphicon glyphicon-remove"></a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="btn btn-raised">
        <a href="{{ url('/admin/stories/create') }}">Toevoegen</a>
    </div>

@endsection