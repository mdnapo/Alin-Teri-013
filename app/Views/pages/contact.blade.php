<?php
$text = App\Page::where('name', 'Contact')->first();
if($text == null){
    $text = new App\Page();
    $text->name = "Contact";
    $text->protected = 1;
    $text->save();
}
?>

@extends('layouts.master')
@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1> Contactpagina </h1>

            <?php echo $text->html ?>

            <br>

            <form method="POST" target="./contact" class="well well-lg" >
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