@extends('layouts.admindashboard')
@section('adminPanel')
    <form class="well well-lg form-horizontal" role="form" method="POST"
          action="{{ ($cat->name == 'Nieuwe categorie') ? url('/admin/cat/0'):url('/admin/cat/' . $cat->id) }}">
        {!! csrf_field() !!}

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label class="col-md-4 control-label" for="inputDefault">Naam</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="name"
                       value="{{ (old('name') != null) ? old('name'):$cat->name }}">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    <i class="material-icons">done</i>
                </button>
                <a href="{{ url('/admin/faq') }}" class="btn btn-primary"><i class="material-icons">cancel</i></a>
            </div>
        </div>
    </form>
@stop