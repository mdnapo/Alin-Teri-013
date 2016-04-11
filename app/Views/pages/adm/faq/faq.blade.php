@extends('layouts.admindashboard')
@section('adminPanel')
    <form class="well well-lg form-horizontal" role="form" method="POST"
          action="{{ ($faq->question == 'Nieuwe vraag') ? url('/admin/faq/0'):url('/admin/faq/' . $faq->id) }}">
        {!! csrf_field() !!}
        <input type="hidden" name="new"
               value="{{ ($faq->name == 'Nieuwe vraag') ? 'true':'false' }}"></input>

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
            <label for="parent" class="col-md-4 control-label">Categorie</label>
            <div class="col-md-6">
                <select id="cat" class="form-control" name="cat" value="{{ (old('cat') != null) ? old('cat'):$faq->cat_id }}">
                    @foreach($cats as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label" for="inputDefault">Vraag</label>
            <div class="col-md-6">
                <input type="text" class="form-control" name="question"
                       value="{{ (old('question') != null) ? old('question'):$faq->question }}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-4 control-label">Antwoord</label>

            <div class="col-md-6">
                <input type="email" class="form-control" name="answer"
                       value="{{ (old('answer') != null) ? old('answer'):$faq->answer }}">
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
@endsection