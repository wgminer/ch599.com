<?php if (isset($user)) : ?>

<header class="toolbar">
    <a href="/" class="toolbar__title">599</a>
    <div class="toolbar__group">
        <a href="" class="toolbar__link">New Post</a>
        <div class="dropdown toolbar__dropdown">
            <span class="dropdown__title"><?php echo $user->name;?> <i class="ion-arrow-down-b"></i></span>
            <div class="dropdown__menu">
                <ul class="dropdown__list">
                    <li class="dropdown__item"><a href="">Dashboard</a></li>
                    <li class="dropdown__item"><a href="">Settings</a></li>
                    <li class="dropdown__item"><a href="sign-out">Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>

<?php endif; ?>