<?php
$items = App\Page::where('archived', 0)->orderBy('sort')->get();
$archived = App\Page::where('archived', 1)->get();
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
    <h1>Archief van pagina's</h1>
    <table class="table table-bordered" >
        <thead>
        <th>#</th>
        <th>Naam</th>
        <th>Datum van verwijdering</th>
        <th>Acties</th>
        </thead>
        <tbody>
            @foreach($archived as $archive)
                <th scope="row" class="#{{ $archive->id }}">{{ $archive->id }}</th>
                <td>{{ $archive->name }}</td>
                <td>{{ $archive->updated_at }}</td>
                <td>
                    <a class="plain_link" data-toggle="tooltip" title="Herstellen" href="{{ url('/admin/pages/restore/' . $archive->id) }}"><span class="material-icons">restore_page</span></a>
                    <a class="plain_link" data-toggle="tooltip" title="Pagina bekijken" href="{{ url('/admin/pages/viewArchive/' . $archive->id) }}"><span class="material-icons">open_in_browser</span></a>
                </td>
            @endforeach
        </tbody>
    </table>
@stop

@section('footer')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
