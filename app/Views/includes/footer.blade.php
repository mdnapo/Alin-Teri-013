<!-- jQuery and Bootstrap-->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<!-- Material Scripts -->
<script src="{{ asset('js/material.js') }}"></script>
<script src="{{ asset('js/ripples.min.js') }}"></script>

<!--Page specific scripts-->
@yield('footer')

<!-- Material initialisation -->
<script type="text/javascript">
    $(function () {
        $.material.init();
    });
</script>
