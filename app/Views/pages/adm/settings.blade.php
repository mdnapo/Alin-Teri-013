@extends('layouts.admindashboard')
@section('adminPanel')
    <h1>Settings</h1>
    @foreach($cats as $cat)
        <div class="row">
            <h2 style="display:inline;">{{ $cat->name }}</h2>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                <th>Setting</th>
                <th>Waarde</th>
                </thead>
                <tbody>
                @foreach($cat->$settings as $setting)
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
        </div>
    @endforeach
    <div class="btn btn-raised">
        <a href="{{ url('/admin/cat/0') }}">Categorie Toevoegen</a>
    </div>
    <div class="btn btn-raised">
        <a href="{{ url('/admin/faq/0') }}">FAQ Toevoegen</a>
    </div>
@endsection