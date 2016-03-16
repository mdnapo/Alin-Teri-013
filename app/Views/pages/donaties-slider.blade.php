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
            <div class="col-md-8 col-md-offset-2">
                <!--The thumbnail carousel-->
                <div id="thumb_carousel" class="carousel slide" data-interval="false">
                    <div class="carousel-inner">
                        @for($i = 0; $i < ceil(count($donations)/5); $i++)
                            <div class="item @if($i == 0){{ 'active' }}@endif">
                                @for($j = ($i*5); $j < ($i*5) + 5 && $j < count($donations); $j++)
                                    <div data-target="#main_carousel" data-slide-to="{{$j}}" class="thumb">
                                        <img class="img-responsive" src="{{ $donations[$j] }}">
                                    </div>
                                @endfor
                            </div>
                        @endfor
                    </div><!-- /carousel-inner -->
                    {{--If there are more then 5 pictures show add carousel controls--}}
                    @if(ceil(count($donations)/5) > 1)
                        <a class="left carousel-control" href="#thumb_carousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#thumb_carousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    @endif
                </div><!-- /thumbcarousel -->
            </div>

            <!--The main carousel-->
            <div class="col-md-8 col-md-offset-2">
                <div id="main_carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @for($i = 0; $i < count($donations); $i++)
                            <div class="item @if($i == 0){{ 'active' }}@endif">
                                <a data-toggle="lightbox" href="{{$donations[$i]}}" data-gallery="donations_gallery">
                                    <img class="center-block img-responsive" src="{{$donations[$i]}}">
                                </a>
                            </div>
                        @endfor
                    </div>
                    {{--If there is more than 1 picture add carousel controls--}}
                    @if(count($donations) > 1)
                        <a class="left carousel-control" href="#main_carousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#main_carousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    @endif
                </div><!-- /main carousel -->
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
                                <div class="preview_container" style="margin-bottom: 10px;">
                                    <img class="center-block" id="upload_preview" src="">
                                </div>
                                <div class="controls">
                                    <input id="file_select" type="file" name="image" accept="image/*" required>
                                    <input type="hidden" id="cropped_width" name="width" value=""/>
                                    <input type="hidden" id="cropped_height" name="height" value=""/>
                                    <input type="hidden" id="cropped_x" name="x" value=""/>
                                    <input type="hidden" id="cropped_y" name="y" value=""/>
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
<link rel="stylesheet" href="css/ekko-lightbox.min.css"/>
<link href="css/cropper.min.css" rel="stylesheet">
<script src="js/ekko-lightbox.min.js"></script>
<script src="js/cropper.min.js"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var $image = $("#upload_preview");
                $image.cropper('replace', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function(){
        $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });

        $("#file_select").change(function(){
            readURL(this);
        });

        var $image = $("#upload_preview");
        $image.cropper({
            viewMode: 1,
            aspectRatio: 1/1,
            resizable: true,
            responsive: true,
            autoCropArea: 1,
            zoomable: false,
            rotatable: false,
            crop: function(data) {
                $("#cropped_width").val(parseInt(data.width));
                $("#cropped_height").val(parseInt(data.height));
                $("#cropped_x").val(parseInt(data.x));
                $("#cropped_y").val(parseInt(data.y));
            }
        });
    });
</script>
@stop