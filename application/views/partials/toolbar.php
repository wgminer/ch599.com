<?php if (isset($user)) : ?>

<header class="toolbar">
    <div class="toolbar__group">
        <a href="new" class="toolbar__link">New</a>
        <div class="dropdown toolbar__dropdown">
            <span class="dropdown__title"><?php echo $user->name;?> <i class="ion-arrow-down-b"></i></span>
            <div class="dropdown__menu">
                <ul class="dropdown__list">
                    <li class="dropdown__item"><a href="<?php echo base_url() ?>dashboard">Dashboard</a></li>
                    <li class="dropdown__item"><a href="<?php echo base_url() ?>settings">Settings</a></li>
                    <li class="dropdown__item"><a href="<?php echo base_url() ?>sign-out">Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>

<?php endif; ?>