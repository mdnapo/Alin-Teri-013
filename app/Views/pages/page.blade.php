@extends('layouts.master')
@section('content')
    @if (!Auth::guest() && App\User::isAdmin(Auth::user()->id))
        <a href="{{ url('/admin/pages/edit/'.$content->id) }}" id="edit_button" class="glyphicon glyphicon-pencil" style="position: absolute; right: 20px; top: 30px; font-size: 1.5em;"></a>
    @endif
    <?php echo $content; ?>
@stop