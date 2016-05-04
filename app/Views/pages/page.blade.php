@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (!Auth::guest() && Auth::user()->isAdmin())
                <a href="{{ url('/admin/pages/edit/'.$id) }}" id="edit_button" class="glyphicon glyphicon-pencil" style="position: absolute; right: 20px; top: 30px; font-size: 1.5em;"></a>
            @endif
            <?php echo $content; ?>
        </div>
    </div>
@stop