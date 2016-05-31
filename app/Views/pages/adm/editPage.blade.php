<?php
$page = App\Page::where('id', $id)->firstOrFail();
$archives = App\Archive::where('page_id', $id)->get();
?>
@extends('layouts.admindashboard')
@section('adminPanel')
    <form class="well well-lg form-horizontal" method="POST" target="/edit">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <fieldset>
            <legend>PAGINA BEWERKEN</legend>
            <div class="form-group">
                <textarea id="c" name="html">{{ $page->html }}</textarea>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <a href="{{ url('/admin/pages') }}" class="btn btn-primary">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Save"/>
                </div>
            </div>
            <p>
            <h1 class="text-center">Archief</h1>
            <table class="table table-striped table-hover">
                <th>Datum</th>
                <th>Acties</th>
                @foreach($archives as $archive)
                    <tr>
                        <td><span class="under">{{ $archive->updated_at }}</span></td>
                        <td>
                            <a class="plain_link restore" data-toggle="tooltip" title="Herstellen"
                               html="{{ $archive->html }}"><span class="material-icons">restore_page</span></a>
                        </td>
                    </tr>
                @endforeach
            </table>
            </p>
        </fieldset>
    </form>
@stop

@section('footer')
    <script src="https://cdn.ckeditor.com/4.5.8/full/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
            CKEDITOR.replace('c');
            $('.restore').click(function () {
                CKEDITOR.instances['c'].setData($(this).attr("html"));
            });
        });
    </script>
@stop
