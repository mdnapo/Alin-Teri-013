@extends('layouts.admindashboard')
@section('adminPanel')
    {{--Pending donations--}}
    <h3>Nog niet geaccepteerd</h3>
    <div class="row">
        @foreach($pending_donations as $pending)
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="img-thumbnail">
                    <a data-toggle="lightbox" href="{{ asset($pending->pic_loc) }}" data-title="{{ $pending->message }}">
                        <img src="{{ asset($pending->pic_loc) }}" class="img-responsive">
                    </a>
                    <div class="caption">
                        <div><strong>Email:</strong></div>
                        <div>{{ $pending->email != '' ? $pending->email : 'Leeg' }}</div>
                        <div><strong>Opmerking:</strong></div>
                        <div>{!! $pending->message != '' ? $pending->message : 'Leeg' !!}</div>
                        <!--Additional wrapper to center the button group-->
                        <div class="text-center">
                            <div class="btn-group" role="group">
                                <!--The accept button-->
                                <button type="submit" form="{{"donation_accept_$pending->id"}}" class="btn btn-default">
                                    <span class="glyphicon glyphicon-check"></span>
                                </button>
                                <!--The delete button-->
                                <button onclick="delete_image('{{"donation_delete_$pending->id"}}')" class="btn btn-default">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <form method="post" id="{{ "donation_accept_$pending->id" }}" action="./donations/accept/{{ $pending->id }}">
                        <input type="hidden" name="_token" value="<?= csrf_token(); ?>" >
                    </form>
                    <form method="post" id="{{ "donation_delete_$pending->id" }}" action="./donations/delete/{{ $pending->id }}">
                        <input type="hidden" name="_token" value="<?= csrf_token(); ?>" >
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    {{--Pending donations--}}
    <h3>Geaccepteerd</h3>
    <div class="row">
        @foreach($approved_donations as $approved)
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="img-thumbnail">
                    <a data-toggle="lightbox" href="{{ asset($approved->pic_loc) }}" data-gallery="gallery" data-title="{{ $approved->message }}">
                        <img src="{{ asset($approved->pic_loc) }}" class="img-responsive">
                    </a>
                    <div class="caption">
                        <div><strong>Email:</strong></div>
                        <div>{{ $approved->email != '' ? $approved->email : 'Leeg' }}</div>
                        <div><strong>Opmerking:</strong></div>
                        <div>{!! $approved->message != '' ? $approved->message : 'Leeg' !!}</div>
                        <!--Additional wrapper to center the button group-->
                        <div class="text-center">
                            <div class="btn-group" role="group">
                                <!--The delete button-->
                                <button onclick="delete_image('{{ "donation_delete_$approved->id" }}')" class="btn btn-default">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <form method="post" id="{{ "donation_delete_$approved->id" }}" action="./donations/delete/{{ $approved->id }}">
                        <input type="hidden" name="_token" value="<?= csrf_token(); ?>" >
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <script src="{{ asset('js/ekko-lightbox.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script>
        function delete_image(form_id){
            bootbox.confirm('Weet u zeker dat u deze afbeelding wilt verwijderen?', function(answer){
                if(answer === true) $('#' + form_id).submit();
            });
        }
        $(document).ready(function(){
            $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
        });
    </script>
@endsection