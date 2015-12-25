
    <script src="//www.youtube.com/iframe_api"></script>
    <script src="//connect.soundcloud.com/sdk.js"></script>
    <script src="//w.soundcloud.com/player/api.js"></script>

    <script src="<?php echo base_url() ?>libs/jquery/dist/jquery.js"></script>
    <script src="<?php echo base_url() ?>libs/moment/moment.js"></script>
    <script src="<?php echo base_url() ?>libs/lodash/lodash.js"></script>

    <script src="<?php echo base_url() ?>public/js/player.js"></script>
    <script src="<?php echo base_url() ?>public/js/playlist.js"></script>
    <script src="<?php echo base_url() ?>public/js/search.js"></script>
    <script src="<?php echo base_url() ?>public/js/setup.js"></script>

    <?php if (isset($user)) : ?>

    <script>
        var baseUrl = '<?php echo base_url() ?>';
        var user = {
            id: parseInt(<?php echo $user->id ?>),
            name: '<?php echo $user->name ?>',
            slug: '<?php echo $user->slug ?>'
        };
    </script>

    <script src="<?php echo base_url() ?>libs/angular/angular.js"></script>
    <script src="<?php echo base_url() ?>libs/angular-route/angular-route.js"></script>
    <script src="<?php echo base_url() ?>public/js/admin/app.js"></script>
    <script src="<?php echo base_url() ?>public/js/admin/controllers.js"></script>
    <script src="<?php echo base_url() ?>public/js/admin/directives.js"></script>
    <script src="<?php echo base_url() ?>public/js/admin/services.js"></script>

    <?php endif; ?>

    <script>
        if (window.location.href.indexOf('localhost')) {
            document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>');
        }
    </script>

</body>
</html>