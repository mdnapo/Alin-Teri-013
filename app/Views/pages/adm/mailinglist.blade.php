@extends('layouts.admindashboard')
@section('adminPanel')
    <h1>Mailinglist</h1>
    <div class="row">
        <div class="col-xs-12">
            <form action="{{ url('/admin/mailinglist') }}">
                <div class="input-group">
                    <input name="needle" type="text" class="form-control" placeholder="Zoeken naar..."
                           value="{{ isset($needle) ? $needle : '' }}">
                    <span class="input-group-btn">
                        <button type="submit" id="search" class="btn btn-primary"><span
                                    class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
            </form>
        </div>
    </div>
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
    @if(count($list) > 0)
        <div class="row">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>E-Mail</th>
                    <th>Delete</th>
                </thead>
                </tr>
                <tbody>
                @foreach($list as $mailing)
                    <tr>
                        <td>{{ $mailing->email }}</td>
                        <td><a id="{{ $mailing->id }}" class="delete_mail"><i class="material-icons">delete</i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @elseif(isset($needle) && $needle != '')
        <h3>Geen e-mail adressen gevonden voor de term '{{ $needle }}'.</h3>
    @else
        <h3>Nog geen e-mail adressen.</h3>
    @endif
    <div class="row">
        <h4>Voeg nieuwe mail adressen toe:</h4>
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
        <div class="pagination-centered col-xs-12">{!! $list->render() !!}</div>
    </div>
@stop
@section('footer')
    <script src="{{ asset('js/bootbox.min.js') }}"></script>
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