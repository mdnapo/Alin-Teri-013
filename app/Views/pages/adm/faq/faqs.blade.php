@extends('layouts.admindashboard')
@section('adminPanel')
    <h1>FAQ</h1>
    @foreach($cats as $cat)
        <div>
            <form action="{{ url('/admin/cat/' . $cat->id) }}" method="POST">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}
                <h2 style="display:inline;">{{ $cat->name }}</h2>
                <a href="{{ url('/admin/cat/'.$cat->id) }}" class="glyphicon glyphicon-pencil"></a>

                @if($cat->faqs->isEmpty())
                    <button type="submit" id="delete-faq-{{ $cat->id }}"
                            style="outline: 0; border: 0; background:0;" class="glyphicon glyphicon-remove">
                    </button>
                @endif

            </form>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Vraag</th>
                <th>Antwoord</th>
                <th>Aanpassen</th>
                <th>Verwijderen</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cat->faqs as $faq)
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
    @endforeach
    <div class="btn btn-raised">
        <a href="{{ url('/admin/cat/0') }}">Categorie Toevoegen</a>
    </div>
    <div class="btn btn-raised">
        <a href="{{ url('/admin/faq/0') }}">FAQ Toevoegen</a>
    </div>
@stop