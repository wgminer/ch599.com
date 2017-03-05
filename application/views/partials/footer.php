
    <script src="//www.youtube.com/iframe_api"></script>
    <script src="//connect.soundcloud.com/sdk.js"></script>
    <script src="//w.soundcloud.com/player/api.js"></script>

    <script src="<?php echo base_url() ?>public/js/599.js"></script>

    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-35251422-1']);
        _gaq.push(['_trackPageview']);
        (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>

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

</body>
</html>