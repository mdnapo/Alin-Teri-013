@extends('layouts.admindashboard')
@section('adminPanel')
    <table class="table table-bordered">
        <thead>
        <th>#</th>
        <th>Vraag</th>
        <th>Antwoord</th>
        <th>Aanpassen</th>
        <th>Verwijderen</th>
        </thead>
        <tbody>
        @foreach($faqs as $faq)
            <tr>
                <th scope="row" class="#{{ $faq->id }}">{{ $faq->id }}</th>
                <td>{{ $faq->question }}</td>
                <td>{{ $faq->answer }}</td>
                <td>
                    <a href="{{ url('/admin/faq/'.$faq->id) }}" class="glyphicon glyphicon-pencil"></a>
                </td>
                <td>
                    <form action="{{ url('/admin/faq/' . $faq->id) }}" method="POST">
                        {!! csrf_field() !!}
                        {!! method_field('DELETE') !!}

                        <button type="submit" id="delete-faq-{{ $faq->id }}"
                                style="outline: 0; border: 0; background:0;" class="glyphicon glyphicon-remove">
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="btn btn-raised">
        <a href="{{ url('/admin/faq/0') }}">Toevoegen</a>
    </div>

@endsection