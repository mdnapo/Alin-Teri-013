@extends('layouts.master')
@section('content')

    <div class="row">
        @if(count($errors) > 0)
            <div class="col-md-8">
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

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
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                <label class="control-label" for="bericht">Uw vraag</label>
                <p><td><br><textarea name="vraag">{{ session('opmerking') }}</textarea></td></p>
                <input type="submit" class="btn btn-default" value="Versturen" />
            </form>
        </div>
    </div>

@endsection