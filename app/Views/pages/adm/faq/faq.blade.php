@extends('layouts.admindashboard')
@section('adminPanel')
    <form class="well well-lg form-horizontal" role="form" method="POST"
          action="{{ ($faq->question == 'Nieuwe vraag') ? url('/admin/faq/0'):url('/admin/faq/' . $faq->id) }}">
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
            <label for="parent" class="col-md-4 control-label">Categorie</label>
            <div class="col-md-6">
                <select id="cat" class="form-control" name="cat" value="">
                    @foreach($cats as $cat)
                        <option selected="{{ ((old('cat') == $cat->id) || ((old('cat') == null) && ($faq->category_id == $cat->id))) ? "selected":"" }}"
                                value="{{ $cat->id }}">{{ $cat->name }}</option>
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
                <textarea class="form-control" rows="2" name="answer">
                    {{ (old('answer') != null) ? old('answer'):$faq->answer }}
                </textarea>
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