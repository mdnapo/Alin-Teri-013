@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (!Auth::guest() && Auth::user()->isAdmin())
                <a class="plain_link" data-toggle="tooltip" title="Herstellen"
                   href="{{ url('/admin/pages/restore/' . $id) }}" style="position: absolute; right: 20px;"><span
                            class="material-icons" style="font-size: 3em;">restore_page</span></a>
            @endif
            <?php echo $content; ?>
        </div>
    </div>
@stop