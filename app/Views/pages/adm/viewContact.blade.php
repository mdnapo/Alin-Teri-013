@extends('layouts.admindashboard')
@section('adminPanel')

    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="panel-title">Vraag #{{ $contact->id }}</div>
        </div>
        <div class="panel-body">
            <p>
                <strong>Email: </strong>{{ $contact->email }}<br/>
            </p>
            <p>
                <strong>Datum en tijd: </strong>{{ $contact->created_at }}<br/>
            </p>
            <p>
                <strong>Bericht:</strong>
                <br/>
                {!! $contact->bericht !!}<br/>
            </p>
        </div>
    </div>

    <a href="{{ url('/admin/contact') }}" class="plain_link">
        <button class="btn btn-primary">
            Terug
        </button>
    </a>

    <a onclick="delete_contact('{{ $contact->id }}')" class="plain_link">
        <button class="btn btn-primary">
            Vraag verwijderen
        </button>
        <form id="{{ $contact->id }}" action="{{ url('/admin/contact/delete/'.$contact->id) }}" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
            <input type="hidden" name="id" value="{{ $contact->id }}">
        </form>
    </a>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script>
        function delete_contact(id){
            bootbox.confirm('Weet u zeker dat u dit bericht wilt verwijderen?', function(answer){
                if(answer === true) $('#' + id).submit();
            });
        }
        $(document).ready(function(){
            $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
        });
    </script>

@endsection