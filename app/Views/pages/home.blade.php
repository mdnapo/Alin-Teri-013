<?php
    $text = App\Page::where('name', 'Home')->first();
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
            <?php echo $text->html ?>
        </div>
        <div class="col-md-4">
            <div class="fb-page" data-href="https://www.facebook.com/alinteri013/" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/alinteri013/"><a href="https://www.facebook.com/alinteri013/">Alin Teri</a></blockquote></div></div>
        </div>
    </div>
@endsection