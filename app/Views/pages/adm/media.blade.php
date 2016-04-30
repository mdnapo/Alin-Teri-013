@extends('layouts.admindashboard')
@section('adminPanel')

    <div class="col-xs-12">
        <h2>Media publicaties</h2>
    </div>

    <table class="table table-bordered" >
        <thead>
            <th>#</th>
            <th>Bron</th>
            <th>Artikel</th>
            <th>Toegevoegd op</th>
            <th>Bekijken</th>
            <th>Verwijderen</th>
        </thead>
        <tbody>
        @foreach($publications as $publication)
            <tr>
                <th scope="row" class="#{{ $publication->id }}">{{ $publication->id }}</th>
                <td>{{ $publication->source }}</td>
                <td>{!! substr($publication->article, 0, 60) !!}</td>
                <td>{{ $publication->created_at }}</td>
                <td>
                    <a onclick="delete_contact('{{ $publication->id }}')" class="glyphicon glyphicon-file plain_link">
                        <form id="{{ $publication->id }}" action="#" method="POST">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <input type="hidden" name="id" value="{{ $publication->id }}">
                        </form>
                    </a>
                </td>
                <td>
                    <a onclick="delete_contact('{{ $publication->id }}')" class="glyphicon glyphicon-remove plain_link">
                        <form id="{{ $publication->id }}" action="#" method="POST">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <input type="hidden" name="id" value="{{ $publication->id }}">
                        </form>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script>
        function delete_contact(id){
            bootbox.confirm('Weet u zeker dat u dit bericht wilt verwijderen?', function(answer){
                if(answer === true) $('#' + id).submit();
            });
        }
    </script>
@endsection