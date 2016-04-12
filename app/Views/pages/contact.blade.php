@extends('layouts.master')
@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1> Contactpagina </h1>

            <p><b>Naam:</b> Alin Teri</p>
            <p><b>Telefoonnummer:</b> +316123456</p>
            <p><b>Email adres:</b> AlinTeri@Voorbeeld.nl</p>
            <p><b>Locatie:</b> Voorbeeldstraat 1</p>

            <br>

            <form method="POST" action="./contact" class="well well-lg" >
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
                <label class="control-label" for="email">Uw email</label>
                <input type="email" class="form-control" id="email" name="email">
                <label class="control-label" for="bericht">Uw vraag</label>
                <p><td><br><textarea name="opmerking"></textarea></td></p>
                <input type="submit" class="btn btn-default" value="Versturen" />
            </form>
        </div>
    </div>

@endsection