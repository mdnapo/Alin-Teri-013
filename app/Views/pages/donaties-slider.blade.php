<?php
$text = App\Page::where('name', 'Steun ons')->first();
if($text == null){
    $text = new App\Page();
    $text->name = "Steun ons";
    $text->protected = 1;
    $text->save();
}
?>

@extends('layouts.master')
@section('head')
    <link rel="stylesheet" href="css/ekko-lightbox.min.css"/>
    <link href="css/cropper.min.css" rel="stylesheet">
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2><strong>Steun ons!</strong></h2>
            </div>
            <div class="col-xs-12">
                <?php echo $text->html ?>
            </div>
            <div class="col-xs-12">
                <strong><em>Onze ambassadeurs, bondgenoten en vrijwilligers</em></strong>
            </div>

            <div class="col-xs-10 col-xs-offset-1">
                <div class="btn-group pull-right">
                    {{--<a href="{{ url('steun-ons-carousel') }}"><div class="btn btn-primary">Carousel</div></a>--}}
                    <a href="{{ url('steun-ons-gallerij') }}"> <div class="btn btn-primary">Gallerij</div></a>
                </div>
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
                                            <img class="img-responsive" src="{{ $donations[$j]->pic_loc }}">
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
                                    <a data-toggle="lightbox" href="{{ $donations[$i]->pic_loc }}" data-gallery="donations_gallery"  data-footer="{{ $donations[$i]->message }}">
                                        <img class="center-block img-responsive" src="{{ $donations[$i]->pic_loc }}">
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
            <div class="col-xs-10 col-xs-offset-1" id="doneer_nu">
                <button class="btn btn-primary btn-block" id="doneer_knop" data-toggle="modal"
                        data-target="#upload_modal">Steun ons!
                </button>
                <button class="btn btn-primary btn-block" id="optin_knop" data-toggle="modal"
                        data-target="#optin_modal">Meld je aan voor de nieuwsbrief!
                </button>
            </div>

            <!--The modal for uploading a new image-->
            <div id="upload_modal" class="modal fade" role="dialog">
                <form method="POST" enctype="multipart/form-data" action="./steun-ons">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Kies een afbeelding.</h4>
                            </div>

                            <div class="modal-body">
                                <div class="control-group form-group">
                                    <div class="preview_container">
                                        <img class="center-block" id="upload_preview" src="">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <button type="button" class="btn btn-primary btn-block"
                                                        id="rotate_left">Links draaien
                                                </button>
                                            </div>
                                            <div class="col-xs-6">
                                                <button type="button" class="btn btn-primary btn-block"
                                                        id="rotate_right">Rechts draaien
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input id="file_select" type="file" name="image" accept="image/*" required>
                                        <button class="btn btn-block btn btn-primary">Kies een afbeelding.</button>
                                        <input type="hidden" id="cropped_width" name="width" value=""/>
                                        <input type="hidden" id="cropped_height" name="height" value=""/>
                                        <input type="hidden" id="cropped_x" name="x" value=""/>
                                        <input type="hidden" id="cropped_y" name="y" value=""/>
                                        <input type="hidden" id="cropped_rotation" name="rotation" value="0"/>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-xs-12 control-label">E-Mail Address:</label>
                                        <input type="email" class="form-control" name="email" required>
                                        <span class="help-block">
                                            Het ingevoerde e-mailadres zal niet openbaar gedeeld worden met anderen.
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="mailinglistcb" value="1" checked> Meld mij aan voor de
                                    nieuwsbrief<br>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-12 control-label">Bericht (optioneel):</label>
                                    <div class="col-xs-12">
                                        <textarea class="form-control" name="opmerking"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-default" value="Uploaden"/>
                                <button class="btn btn-default" data-dismiss="modal">Annuleren</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!--The modal for registering for the newsletter-->
            <div id="optin_modal" class="modal fade" role="dialog">
                <form method="POST" enctype="multipart/form-data" action="./newsletter/optin">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Vul uw email in</h4>
                            </div>
                            <div class="modal-body">
                                <div class="control-group form-group">
                                    <div class="form-group">
                                        <label class="col-xs-12 control-label">E-Mail Address:</label>
                                        <div class="col-xs-12">
                                            <input type="email" class="form-control" name="email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-default" value="Aanmelden"/>
                                <button class="btn btn-default" data-dismiss="modal">Annuleren</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@stop

@section('footer')
    <script src="js/ekko-lightbox.min.js"></script>
    <script src="js/cropper.min.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var $image = $("#upload_preview");
                    $image.cropper('replace', e.target.result);
                    $("#rotate_left").show();
                    $("#rotate_right").show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).ready(function () {
            $("#rotate_left").hide();
            $("#rotate_right").hide();
            $(document).delegate('*[data-toggle="lightbox"]', 'click', function (event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });

            $("#rotate_left").click(function () {
                var $image = $("#upload_preview");
                $image.cropper('rotate', 90);
            });

            $("#rotate_right").click(function () {
                var $image = $("#upload_preview");
                $image.cropper('rotate', -90);
            });

            $("#file_select").change(function () {
                readURL(this);
            });

            var $image = $("#upload_preview");
            $image.cropper({
                viewMode: 1,
                aspectRatio: 1 / 1,
                resizable: true,
                responsive: true,
                autoCropArea: 1,
                zoomable: false,
                rotatable: true,
                crop: function (data) {
                    $("#cropped_width").val(parseInt(data.width));
                    $("#cropped_height").val(parseInt(data.height));
                    $("#cropped_x").val(parseInt(data.x));
                    $("#cropped_y").val(parseInt(data.y));
                    $("#cropped_rotation").val(parseInt(data.rotate * -1));
                }
            });
        });
    </script>
@stop