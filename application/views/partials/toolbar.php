<?php if (isset($user)) : ?>

<header class="toolbar">
    <?php if (isset($admin)) : ?>
        <a href="<?php echo base_url() ?>latest" class="toolbar__title">Channel 599</a>
    <?php endif; ?>
    <div class="toolbar__group">
        <button trigger-modal song="false" class="toolbar__link">New</button>
        <div dropdown class="dropdown toolbar__dropdown">
            <span class="dropdown__title" ng-click="toggle()"><?php echo $user->name;?> <i class="ion-arrow-down-b"></i></span>
            <div class="dropdown__menu">
                <ul class="dropdown__list">
                    <li class="dropdown__item"><a href="<?php echo base_url() ?>dashboard/#/published">Dashboard</a></li>
                    <li class="dropdown__item"><a href="<?php echo base_url() ?>settings">Settings</a></li>
                    <li class="dropdown__item"><a href="<?php echo base_url() ?>sign-out">Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>

<?php endif; ?>