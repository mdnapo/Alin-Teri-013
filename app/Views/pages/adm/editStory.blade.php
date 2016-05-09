<?php
$story = App\Story::where('id', $id)->firstOrFail();
?>
@extends('layouts.admindashboard')
@section('adminPanel')
    <form class="well well-lg form-horizontal" method="POST" target="/edit">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
        <fieldset>
            <legend>VERHALEN BEWERKEN</legend>
            <div class="form-group">
                <textarea name="html">{{ $story->html }}</textarea>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <a href="{{ url('/admin/dashboard') }}" class="btn btn-default">Cancel</a>
                    <input type="submit" class="btn btn-default" value="Save" />
                </div>
    </form>
@endsection