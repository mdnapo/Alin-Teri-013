@extends('layouts.admindashboard')
@section('adminPanel')
    <h1>Settings</h1>
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
    @foreach($cats as $cat)
        <div class="row">
            <h4>{{ $cat->name }}</h4>
        </div>
        <div class="row">
            <form action="{{ url('/admin/settings/' . $cat->id) }}" method="POST">
                {!! csrf_field() !!}
                @foreach ($cat->settings as $setting)
                    <div class="form-group">
                        <label class="col-md-2 control-label">{{ $setting->name }}</label>
                        <div class="col-md-10">
                            @foreach ($setting->values as $option)
                                <div class="radio radio-primary">
                                    <label>
                                        <input type="radio" name="{{ "set" . $setting->id }}"
                                               id="{{ "set" . $setting->id }}"
                                               value="{{ $option->value }}" {{ ($setting->value == $option->value) ? 'checked=""':'' }}>{{ $option->value }}
                                        </input>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <div class="col-md-2 col-md-offset-10">
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons">done</i>
                    </button>
                </div>
            </form>
        </div>
    @endforeach
@endsection