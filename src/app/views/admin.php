<!doctype html>
<html class="no-js" ng-app="channel599">
    <?php $this->load->view('includes/head.admin.php'); ?>
    <body class="admin">

        <header class="masthead">
            <h1><a href="<?php echo base_url() ?>"><i class="ion-ios-arrow-thin-left"></i> 599</a></h1>
<!--             <nav>
                <a href="#/" ng-class="{active: currentRoute == 'dashboard'}">Dashboard</a>
                <a href="#/settings" ng-class="{active: currentRoute == 'settings'}">Settings</a>
                <a href="#/logout">Log Out</a>
            </nav> -->
        </header>

        <main class="main" ng-view=""></main>

        <script src="//www.youtube.com/iframe_api"></script>
        <script src="//connect.soundcloud.com/sdk.js"></script>
        <script src="//w.soundcloud.com/player/api.js"></script>
        
        <script src="<?php echo base_url() ?>../bower_components/jquery/dist/jquery.js"></script>
        <script src="<?php echo base_url() ?>../bower_components/angular/angular.js"></script>
        <script src="<?php echo base_url() ?>../bower_components/angular-route/angular-route.js"></script>

        <script src="<?php echo base_url() ?>public/js/admin/app.js"></script>
        <script src="<?php echo base_url() ?>public/js/admin/controllers.js"></script>
        <script src="<?php echo base_url() ?>public/js/admin/services.js"></script>
        <script src="<?php echo base_url() ?>public/js/admin/directives.js"></script>

        <script src="//localhost:35729/livereload.js"></script> 

    </body>
</html>

