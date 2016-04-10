@extends('layouts.admindashboard')
@section('adminPanel')
    <form method="POST" enctype="multipart/form-data" action="{{ url('/admin/newsletter') }}">
        <div class="control-group form-group">
            Upload een bestand en deze wordt automatisch verstuurd naar iedereen die zich heeft ingeschreven voor de nieuwsbrief!
            <div class="form-group label-floating is-empty">
                <label for="subject" class="control-label">Onderwerp</label>
                <input type="text" class="form-control" name="subject" id="subject" required>
            </div>
            <div class="form-group is-empty is-fileinput">
                <input id="file_select" type="file" name="newsletter" accept=".doc, .docx, .pdf" required>
                <input type="text" readonly="" class="form-control" placeholder="Bestand selecteren">
                <span class="material-input"></span>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-block btn-primary" value="Versturen"/>
            </div>
        </div>
    </form>
@endsection