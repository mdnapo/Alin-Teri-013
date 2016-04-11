<?php
    $text = App\Page::where('name', 'Home')->first();
    if($text == null){
        $text = new App\Page();
        $text->name = "Home";
        $text->save();
    }
?>

@extends('layouts.master')
@section('content')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.5";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <div class="row">
        <div class="col-md-8">
            @if (!Auth::guest() && App\User::isAdmin(Auth::user()->id))
                <a href="{{ url('/admin/pages/edit/'.$text->id) }}" id="edit_button" class="glyphicon glyphicon-pencil" style="position: absolute; right: 20px; top: 30px; font-size: 1.5em;"></a>
            @endif
            <?php echo $text->html ?>
        </div>
        </br>
        <div class="col-md-4">
            <div class="fb-page" data-href="https://www.facebook.com/alinteri013/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/alinteri013/"><a href="https://www.facebook.com/alinteri013/">Alin Teri</a></blockquote></div></div>
        </div>
    </div>
@endsection