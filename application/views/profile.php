<?php $this->load->view('partials/head'); ?>
<?php $this->load->view('partials/toolbar'); ?>

<div class="profile" ng-controller="SettingsCtrl">
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
        <button ng-click="updateUser(user)" class="button">Update Profile</button>
    </div>
    <div class="profile__group">
        <div class="form-group">
            <label for="email" class="form-group__label">New Password</label>
            <input id="email" class="form-group__control form-group__control--input" type="password" ng-model="password.new">
        </div>
        <button ng-click="updatePassword(password)" class="button">Update Password</button>
    </div>
</div>

<?php $this->load->view('partials/footer'); ?>
