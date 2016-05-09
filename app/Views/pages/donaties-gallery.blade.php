@extends('layouts.master')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2><strong>Steun ons!</strong></h2>
            </div>
            <div class="col-xs-12">
                <p>
                    <strong>AlinTeri013 is een burgerinitiatief voor eerlijk verdiend brood tegen (soft)drugsgeld. Onze
                        vrijwilligerswerk groep is open voor iedereen die zich herkent in onze boodschap. Één van onze
                        doelen is het krijgen van 5000 profielfoto’s als steunbetuiging. Onze vrijwilligers en
                        ambassadeurs zijn het gezicht van onze publiekscampagne. Steun ons en upload je foto!</strong>
                </p>
            </div>
            <div class="col-xs-12">
                <p><strong><em>Onze ambassadeurs, bondgenoten en vrijwilligers</em></strong></p>
            </div>

            <div class="col-xs-12">
                <div class="btn-group pull-right">
                    <a href="{{ url('steun-ons-carousel') }}"><div class="btn btn-primary">Carousel</div></a>
                    <a href="{{ url('steun-ons-gallerij') }}"> <div class="btn btn-primary">Gallerij</div></a>
                </div>
            </div>

            <!--The gallery-->
            <div class="col-xs-12">
                @foreach($donations as $donation)
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="img-thumbnail">
                            <a data-toggle="lightbox" href="{{ asset($donation->pic_loc) }}" data-title="{{ $donation->message }}">
                                <img src="{{ asset($donation->pic_loc) }}" class="img-responsive">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!--Pagination-->
            <div class="col-xs-12">
                <div class="text-center">
                    {!! $donations->render() !!}
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