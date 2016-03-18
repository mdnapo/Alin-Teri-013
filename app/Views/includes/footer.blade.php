<!-- Material Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.9/js/material.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.9/js/ripples.min.js"></script>
<script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>

<script>
    $(document).ready(function() {
        $.material.init();
        tinymce.init({ selector:'textarea' });
    });
</script>