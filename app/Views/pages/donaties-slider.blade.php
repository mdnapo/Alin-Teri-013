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
            <div class="col-xs-8 col-xs-offset-2">
                <!--The thumbnail carousel-->
                <div id="thumb_carousel" class="carousel slide" data-interval="false">
                    <div class="carousel-inner">
                        @for($i = 0; $i < ceil(count($donations)/4); $i++)
                            <div class="item @if($i == 0){{ 'active' }}@endif">
                                @for($j = ($i*4); $j < ($i*4) + 4 && $j < count($donations); $j++)
                                    <div data-target="#main_carousel" data-slide-to="{{$j}}" class="thumb">
                                        <img src="{{ $donations[$j] }}">
                                    </div>
                                @endfor
                            </div>
                        @endfor
                    </div><!-- /carousel-inner -->
                    <a class="left carousel-control" href="#thumb_carousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#thumb_carousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div><!-- /thumbcarousel -->
            </div>

            <!--The main carousel-->
            <div class="col-xs-8 col-xs-offset-2">
                <div id="main_carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @for($i = 0; $i < count($donations); $i++)
                            <div class="item @if($i == 0){{ 'active' }}@endif">
                                <img src="{{$donations[$i]}}">
                            </div>
                        @endfor
                    </div>
                </div><!-- /thumbcarousel -->
            </div>
        </div>
        <div class="col-xs-8 col-xs-offset-2" id="doneer_nu">
            <button class="btn btn-info btn-block" id="doneer_knop" data-toggle="modal" data-target="#upload_modal">Doneer nu jouw foto!</button>
        </div>

        <!--The modal for uploading a new image-->
        <div id="upload_modal" class="modal fade" role="dialog">
            <form  method="POST" enctype="multipart/form-data" action="./donaties">
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
                                    <label>E-Mail Adres (optioneel):</label>
                                    <input type="email" class="form-control" name="enail">
                                </div>
                                <div class="controls">
                                    <label>Bericht (optioneel):</label>
                                    <textarea class="form-control" name="opmerking"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-default" value="Uploaden" />
                            <button class="btn btn-default" data-dismiss="modal">Annuleren</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop