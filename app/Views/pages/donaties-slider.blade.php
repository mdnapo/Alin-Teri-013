@extends('layouts.master')
@section('content')

<div class="container">
    <h3>Onze donateurs!</h3>
    <div class="row">
        <div class="col-xs-12">
            <p>
                Wij van Alin Teri zien graag wie ons steunen. Daarom hebben wij een eigen actie: laat je steun zien met een foto! Hieronder kun je zien wie ons steunen. Wil jij ook je steun laten zien? Stuur ons jou foto in!
            </p>
        </div>
        <div class="col-xs-12">
            <hr>
        </div>
        <div class="col-xs-12">
            <div class="fotorama" data-nav="thumbs" data-width="100%" data-ratio="2/1">
                @for($i = 0; $i < count($donations); $i++)
                    <img id="{{$i}}" src='{{$donations[$i]}}'/>
                @endfor
            </div>
        </div>
        <div class="col-xs-8 col-xs-offset-2" id="doneer_nu">
            <button class="btn btn-info btn-block" id="doneer_knop" data-toggle="modal" data-target="#upload_modal">Doneer nu jouw foto!</button>
        </div>

        <!--The modal for uploading a new image-->
        <div id="upload_modal" class="modal fade" role="dialog">
            <!---->
            <form  method="POST" enctype="multipart/form-data" action="/donaties">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Kies een afbeelding.</h4>
                        </div>

                        <div class="modal-body">
                            <div class="control-group form-group">
                                <div class="controls">
                                    <input type="file" name="image" accept="image/*" required>
                                </div>
                                <div class="controls">
                                    <label>Emailadres(optioneel):</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="controls">
                                    <label>Bericht(optioneel):</label>
                                    <textarea class="form-control" name="opmerking"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default" data-dismiss="modal">Uploaden</button>
                            <button class="btn btn-default" data-dismiss="modal">Annuleren</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">

@stop