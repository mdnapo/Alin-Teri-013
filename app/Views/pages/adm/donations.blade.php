@extends('layouts.admindashboard')
@section('adminPanel')
    {{--Pending donations--}}
    <h1>Steun ons</h1>
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
                                <button id="{{ $pending->id }}"  class="btn btn-default accept_image">
                                    <a class="glyphicon glyphicon-check plain_link"></a>
                                </button>
                                <!--The delete button-->
                                <button id="{{ $pending->id }}" class="btn btn-default delete_image">
                                    <a class="glyphicon glyphicon-remove plain_link"></a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{--Accepted donations--}}
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
                                <button id="{{ $approved->id }}"  class="btn btn-default delete_image">
                                    <a class="glyphicon glyphicon-remove plain_link"></a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@stop

@section('footer')
    <script src="{{ asset('js/ekko-lightbox.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script>
        $(document).ready(function(){
            $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
            $('.accept_image').click(function(){
                var id = $(this).attr('id');
                var form = document.createElement('form');
                form.method = 'POST';
                form.action  = '{{ url('/admin/donations/accept') }}/' + id;
                var token = document.createElement('input');
                token.name = '_token';
                token.value = '{{ csrf_token() }}';
                form.appendChild(token);
                form.submit();
            });
            $('.delete_image').click(function(){
                var id = $(this).attr('id');
                bootbox.confirm('Weet u zeker dat u deze afbeelding wilt verwijderen?', function(answer){
                    if(answer === true){
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action  = '{{ url('/admin/donations/delete') }}/' + id;
                        var token = document.createElement('input');
                        token.name = '_token';
                        token.value = '{{ csrf_token() }}';
                        form.appendChild(token);
                        form.submit();
                    }
                });
            });
        });
    </script>
@stop