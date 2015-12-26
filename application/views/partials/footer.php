
    <script src="//www.youtube.com/iframe_api"></script>
    <script src="//connect.soundcloud.com/sdk.js"></script>
    <script src="//w.soundcloud.com/player/api.js"></script>

    <script src="<?php echo base_url() ?>public/js/599.js"></script>

    <?php if (isset($user)) : ?>

    <script>
        var baseUrl = '<?php echo base_url() ?>';
        var user = {
            id: parseInt(<?php echo $user->id ?>),
            name: '<?php echo $user->name ?>',
            slug: '<?php echo $user->slug ?>'
        };
    </script>

    <script src="<?php echo base_url() ?>public/js/admin.js"></script>

    <?php endif; ?>

    <script>
        if (window.location.href.indexOf('localhost')) {
            document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>');
        }
    </script>
    
</body>
</html>