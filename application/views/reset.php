<?php $this->load->view('partials/head'); ?>
<div class="profile">
    <p style="min-height: 44px;" class="js--welcome"></p>
</div>
<div class="profile" ng-controller="ResetCtrl">
    <div class="profile__group">
        <div class="form-group">
            <label for="name" class="form-group__label">Name</label>
            <input id="name" class="form-group__control form-group__control--input" type="text" ng-model="user.name">
        </div>
        <div class="form-group">
            <label for="email" class="form-group__label">Email</label>
            <input id="email" class="form-group__control form-group__control--input" type="email" ng-model="user.email">
        </div>
        <div class="form-group">
            <label for="bio" class="form-group__label">Bio</label>
            <textarea id="bio" class="form-group__control form-group__control--textarea" rows="6" ng-model="user.bio"></textarea>
        </div>
        <div class="form-group">
            <label for="email" class="form-group__label">New Password</label>
            <input id="email" class="form-group__control form-group__control--input" type="password" ng-model="password">
        </div>
        <button style="margin: 2rem 0 4rem;" ng-click="save(user, password)" class="button button--primary">Save and Continue</button>
    </div>
</div>

    <script src="<?php echo base_url() ?>public/js/599.js"></script>
    
    <script>
        $('.profile .js--welcome').typed({
            strings: ["Welcome back <?php echo $user->name; ?>.<br>Review your profile and set a new password."],
            contentType: 'html',
            showCursor: false
        });
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