@extends('layouts.admindashboard')
@section('adminPanel')
    <h1>Contact</h1>
    <div class="col-xs-12">
        <h3>Wijzig hieronder het contact emailadres voor gestelde vragen.</h3>
    </div>
    <div class="col-xs-12">
        <form method="POST" action="./contact/setContactEmail">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <label class="control-label" for="email">Contact e-mailadres</label>
            <input class="form-control" name="email" type="email" value="{{ $contact_email->email }}">
            <input type="submit" class="btn btn-default" value="Wijzigen" />
        </form>
    </div>

    <div class="col-xs-12">
        <h2>Gestelde vragen</h2>
    </div>
    <table class="table table-bordered" >
        <thead>
        <th>#</th>
        <th>Email</th>
        <th>Inhoud</th>
        <th>Datum en tijd</th>
        <th>Bekijken</th>
        <th>Verwijderen</th>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <th scope="row" class="#{{ $item->id }}">{{ $item->id }}</th>
                <td>{{ $item->email }}</td>
                <td>{!! substr($item->bericht, 0, 60) !!}</td>
                <td>{{ $item->created_at }}</td>
                <td>
                    <a href="{{ url('/admin/contact/view/'.$item->id) }}" class="glyphicon glyphicon-file plain_link"></a>
                </td>
                <td>
                    <a id="{{ $item->id }}" class="glyphicon glyphicon-remove plain_link delete_message"></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.delete_message').click(function(){
                var id = $(this).attr('id');
                bootbox.confirm('Weet u zeker dat u dit bericht wilt verwijderen?', function(answer){
                    if(answer === true){
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action  = '{{ url('/admin/contact/delete') }}/' + id;
                        var token = document.createElement('input');
                        token.name = '_token';
                        token.value = '{{ csrf_token() }}';
                        form.appendChild(token);
                        form.submit();
                    }
                });
            });
        })
    </script>;
@endsection