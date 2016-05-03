<?php
    $mails = App\Mailinglist::all();
?>
@extends('layouts.admindashboard')
@section('adminPanel')
    <h1>Nieuwsbrief</h1>
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
            <div class="row">
                <div class="col-lg-6">
                    <h4>E-mails waarnaar deze mail verstuurd wordt:</h4>
                    <table class="table table-striped table-hover">
                        <tbody>
                        @foreach($mails as $mail)
                            <tr>
                                <td>{{ $mail->email }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6">
                    <h4>Eerder verstuurde bestanden:</h4>
                    <form>
                        <div class="form-group label-placeholder is-empty">
                            <label for="search" class="control-label">Zoeken</label>
                            <input type="text" autocomplete="off" class="form-control" id="search">
                        </div>

                    </form>
                    <table id="table" class="table table-striped table-hover">
                        <tbody>
                        @foreach(File::allFiles('newsletter') as $file)
                            <tr>
                                <td><a target="_blank" href="{{ asset('newsletter/' . $file->getFilename()) }}">{{ $file->getFilename() }}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </form>
    <script src="{{url("js/newsletter.js")}}"></script>
@endsection