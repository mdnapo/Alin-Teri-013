<?php
$page = App\Page::where('id', $id)->firstOrFail();
?>
@extends('layouts.admindashboard')
@section('adminPanel')
    <form class="well well-lg form-horizontal" method="POST" target="/edit">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
        <fieldset>
            <legend>PAGINA BEWERKEN</legend>
            <div class="form-group">
                <textarea id="c" name="html">{{ $page->html }}</textarea>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <a href="{{ url('/admin/pages') }}" class="btn btn-default">Cancel</a>
                    <input type="submit" class="btn btn-default" value="Save" />
                </div>
            </div>
        </fieldset>
    </form>
@stop

@section('footer')
    <script src="https://cdn.ckeditor.com/4.5.8/full/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('c');
        });
    </script>
@stop
