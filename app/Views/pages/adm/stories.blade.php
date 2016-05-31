<?php
$items = App\Story::all();
?>

@extends('layouts.admindashboard')
@section('adminPanel')
    <h1>Verhalen</h1>
    <table class="table table-bordered" id="stories_holder">
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
                <td>{{ $item->naam }}</td>
                <td>
                    <a href="{{ url('/admin/stories/edit/'.$item->id) }}"
                       class="glyphicon glyphicon-pencil plain_link"></a>
                </td>
                <td>
                    <a id="{{ $item->id }}" class="glyphicon glyphicon-remove plain_link"></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="btn btn-raised">
        <a href="{{ url('/admin/stories/create') }}">Toevoegen</a>
    </div>
@stop
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).delegate('.glyphicon-remove', 'click', function () {
                var id = $(this).attr('id');
                bootbox.confirm('Weet u zeker dat u dit verhaal wilt verwijderen?', function (answer) {
                    if (answer === true) {
                        $.ajax({
                            type: 'GET',
                            url: '{{ url('/admin/stories/delete') }}/' + id,
                            success: function (data) {
                                $('#stories_holder').replaceWith(data);
                            }
                        })
                    }
                });
            });
        });
    </script>
@stop