@extends('layouts.admindashboard')
@section('adminPanel')

    <div class="col-xs-12">
        <h2>Media publicaties</h2>
    </div>

    <table class="table table-bordered" >
        <thead>
            <th>#</th>
            <th>Bron</th>
            <th>Toegevoegd op</th>
            <th>Bekijken</th>
            <th>Verwijderen</th>
        </thead>
        <tbody>
        @foreach($publications as $publication)
            <tr>
                <th scope="row" class="#{{ $publication->id }}">{{ $publication->id }}</th>
                <td>{{ $publication->source }}</td>
                <td>{{ $publication->created_at }}</td>
                <td>
                    <a href="{{ url('/admin/media/' . $publication->id) }}" class="glyphicon glyphicon-pencil plain_link"></a>
                </td>
                <td>
                    <a id="{{ $publication->id }}" class="glyphicon glyphicon-remove plain_link delete_publication"></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="btn btn-raised">
        <a href="{{ url('/admin/media/0') }}">Toevoegen</a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.delete_publication').click(function(){
                var id = $(this).attr('id');
                bootbox.confirm('Weet u zeker dat u deze publicatie wilt verwijderen?', function(answer){
                    if(answer === true){
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action  = '{{ url('/admin/media/delete') }}/' + id;
                        var token = document.createElement('input');
                        token.name = '_token';
                        token.value = '{{ csrf_token() }}';
                        form.appendChild(token);
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection