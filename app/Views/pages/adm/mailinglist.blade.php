@extends('layouts.admindashboard')
@section('adminPanel')
    <h1>Mailinglist</h1>
    @if (count($errors) > 0)
        <div class="row">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="row">
        <form action="{{ url('/admin/mailinglist') }}" method="POST">
            {!! csrf_field() !!}
            <div class="form-group">
                <label class="col-sm-2 control-label" for="mails">E-Mails (CSV)</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="mails"
                           value="{{ (old('mails') != null) ? old('mails'):""}}">
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons">done</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>E-Mail</th>
                <th>Delete</th>
            </thead>
            </tr>
            <tbody>
            @foreach($list as $mailing)
                <tr>
                    <th scope="row" class="#{{ $mailing->id }}">{{ $mailing->id }}</th>
                    <td>{{ $mailing->email }}</td>
                    <td><a id="{{ $mailing->id }}" class="delete_mail"><i
                                    class="material-icons">delete</i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script>
        $(function () {
            console.log('Setting stuff!');
            $('.delete_mail').on('click', function () {
                var id = $(this).attr('id');
                console.log("Opened");
                bootbox.confirm('Weet u zeker dat u dit mail-adres uit de lijst wilt verwijderen?', function (answer) {
                    if (answer === true) {
                        var form = $('<form action="{{ url('/admin/mailinglist/') }}/' + id + '" method="POST"></form>');
                        form.append('{!! csrf_field() !!}');
                        form.append('{!! method_field('DELETE') !!}');
                        form.submit();
                    }
                });
            });
        });
    </script>
@stop