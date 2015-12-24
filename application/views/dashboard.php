<?php $this->load->view('partials/head'); ?>
<?php $this->load->view('partials/toolbar'); ?>

<div class="list" ng-controller="DashboardCtrl" ng-show="visibleList == 1">
    <section ng-show="published != 'false'" ng-repeat="song in published" data="song" class="list__item song">
        <div class="container container--flex">
            <div class="song__media">
                <div class="aspect-ratio" ng-class="{'aspect-ratio--youtube': song.source == 'youtube', 'aspect-ratio--soundcloud': song.source == 'soundcloud'}">
                    <img class="song__image" src="{{song.image_url}}" alt="">
                </div>
            </div>
            <div class="song__content">
                <h2 class="song__title">{{song.title}}</h2>
                <p class="song__text">{{song.text}}</p>
                <div class="song__actions">
                    <button ng-click="editSong(song, $index)" class="song__button song__edit"><i class="ion-edit"></i></button>
                    <div delete-song class="delete">
                        <button class="song__button delete__initiate"><i class="ion-trash-a"></i></button>
                        <button ng-click="delete(published, song, $index)" class="delete__confirm delete__confirm--delete">Delete</button>
                        <button ng-click="cancel()" class="delete__confirm delete__confirm--cancel">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <p class="list__empty container" ng-hide="published != 'false'">Nothing Published</p>
</div>

<div class="list" ng-show="visibleList == 2">
    <section ng-show="draft != 'false'" ng-repeat="song in draft" data="song" class="list__item song">
        <div class="container container--flex">
            <div class="song__media">
                <div class="aspect-ratio" ng-class="{'aspect-ratio--youtube': song.source == 'youtube', 'aspect-ratio--soundcloud': song.source == 'soundcloud'}">
                    <img class="song__image" src="{{song.image_url}}" alt="">
                </div>
            </div>
            <div class="song__content">
                <h2 class="song__title">{{song.title}}</h2>
                <p class="song__text">{{song.text}}</p>
                <div class="song__actions">
                    <button ng-click="editSong(song, $index)" class="song__button song__edit"><i class="ion-edit"></i></button>
                    <div delete-song class="delete">
                        <button class="song__button delete__initiate"><i class="ion-trash-a"></i></button>
                        <button ng-click="delete(draft, song, $index)" class="delete__confirm delete__confirm--delete">Delete</button>
                        <button ng-click="cancel()" class="delete__confirm delete__confirm--cancel">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <p class="list__empty container" ng-hide="draft != 'false'">No Drafts</p>
</div>

<div class="list" ng-show="visibleList == 3">
    <section ng-show="error != 'false'" ng-repeat="song in error" data="song" class="list__item song">
        <div class="container container--flex">
            <div class="song__media">
                <div class="aspect-ratio" ng-class="{'aspect-ratio--youtube': song.source == 'youtube', 'aspect-ratio--soundcloud': song.source == 'soundcloud'}">
                    <img class="song__image" src="{{song.image_url}}" alt="">
                </div>
            </div>
            <div class="song__content">
                <h2 class="song__title">{{song.title}}</h2>
                <p class="song__text">{{song.text}}</p>
                <div class="song__actions">
                    <button ng-click="editSong(song, $index)" class="song__button song__edit"><i class="ion-edit"></i></button>
                    <div delete-song class="delete">
                        <button class="song__button delete__initiate"><i class="ion-trash-a"></i></button>
                        <button ng-click="delete(error, song, $index)" class="delete__confirm delete__confirm--delete">Delete</button>
                        <button ng-click="cancel()" class="delete__confirm delete__confirm--cancel">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <p class="list__empty container" ng-hide="error != 'false'">Nothing Broken...Yay!</p>
</div>

<?php $this->load->view('partials/footer'); ?>
