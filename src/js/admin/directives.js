'use strict';

app.directive('tabs', function ($location, Api) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {

            var init = function () {
                Api.get('/songs?user_id=' + user.id + '&status_id=3')
                    .then(function (callback) {
                        scope.errors = callback.length;
                        $(element).show();
                    }, function (error) {
                        console.log(error);
                    });
            }

            scope.$on('reload', function(event, data) {
                init();
            });

            init();

            scope.$on('$routeChangeSuccess', function () {
                var path = $location.path();
                scope.status = 1;
                if (path == '/drafts') {
                    scope.status = 2;
                } else if (path == '/errors') {
                    scope.status = 3;
                }
            });

        }
    };
});

app.directive('dropdown', function () {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {

            var $element = $(element);

            scope.toggle = function () {
                $element.toggleClass('is--open');
            }

        }
    };
})

app.directive('toast', function ($rootScope, $location, Api, YouTube, SoundCloud) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {

            scope.message = 'Everything is ok!';

            scope.$on('toast', function(event, data) {
                scope.message = data.message;
                scope.status = data.status;
                show();
            });

            $(element).click(function () {
                $(element).removeClass('is--visible');
            });

            var show = function () {
                $(element).addClass('is--visible');
                setTimeout(function () {
                    $(element).removeClass('is--visible');
                }, 2500);
            }

        }
    }
});

app.directive('reload', function ($rootScope, $location, Api, YouTube, SoundCloud) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {

            scope.$on('reload', function(event, data) {
                window.location.reload(true);
            });

        }
    }
});

app.directive('modal', function ($rootScope, $location, Api, YouTube, SoundCloud) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {

            var $element = $(element);
            scope.confirm = false;

            var showPost = function (status) {

                if (status == 1) {
                    $location.path('/published');
                }

            }

            var init = function () {
                
                $('body').addClass('is--not-scrollable');

                scope.preview = angular.copy(scope.song);

                Api.get('/statuses')
                    .then(function (callback) {
                        scope.statuses = callback;
                    }, function (error) {
                        console.log(error);
                    });

                Api.get('/genres')
                    .then(function (callback) {
                        scope.genres = callback;
                    }, function (error) {
                        console.log(error);
                    });

            };

            init();

            scope.updateButton = function (status_id) {
                if (status_id == 1) {
                    return 'Update';
                } else if (status_id == 2) {
                    return 'Publish';
                } else {
                    return 'Fix';
                }
            }

            scope.close = function () {
                $element.click(function () {
                    $element.remove();        
                    $('body').removeClass('is--not-scrollable');
                });
            }

            scope.submit = function (song, status) {

                $element.hide();
                song.status_id = status;


                Api.post('/songs/create', angular.toJson(song))
                    .then(function (callback) {

                        $rootScope.$broadcast('reload');
                        $rootScope.$broadcast('toast', {
                            message: 'Song posted!', 
                            status: 'success'
                        });

                        $element.remove();
                        $('body').removeClass('is--not-scrollable'); 

                    }, function(error){
                        console.log(error);
                    });
            }

            scope.update = function (song, status) {

                $element.hide();
                song.status_id = status;

                Api.post('/songs/update/' + song.id, angular.toJson(song))
                    .then(function (callback) {

                        $rootScope.$broadcast('reload');
                        $rootScope.$broadcast('toast', {
                            message: 'Song updated!', 
                            status: 'success'
                        });

                        $element.remove(); 
                        $('body').removeClass('is--not-scrollable');

                    }, function(error){
                        console.log(error);
                    });
            }

            scope.delete = function (id) {
                Api.get('/songs/delete/' + id)
                    .then(function (callback) {

                        $rootScope.$broadcast('reload');
                        $rootScope.$broadcast('toast', {
                            message: 'Song deleted!', 
                            status: 'success'
                        });

                        $element.remove(); 
                        $('body').removeClass('is--not-scrollable');

                    }, function(error){
                        console.log(error);
                    });
            }

            var createPreview = function (post) {
                scope.preview.image_url = post.image_url;
                scope.preview.source = post.source;
                scope.preview.source_id = post.source_id;
                scope.preview.source_url = post.source_url;

                if (!scope.preview.title) {
                    scope.preview.title = post.title;
                }
            }

            scope.previewSong = function (url) {

                if (url != '') {
                    if (url.indexOf('youtu') > -1) {
                        YouTube.newYTSong(url)
                            .then(function (callback) {
                                createPreview(callback);
                            }, function (error) {
                                console.log(error);
                            });
                    } else if (url.indexOf('soundcloud') > -1) {
                        SoundCloud.newSCSong(url)
                            .then(function (callback) {
                                createPreview(callback);
                            }, function (error) {
                                console.log(error);
                            });
                    }
                }
            }

        }
    };
});

app.directive('triggerModal', function ($http, $compile, $rootScope, Api) {
    return {
        restrict: 'A',
        scope: {
            song: '='
        },
        link: function (scope, element, attrs) {

            element.bind('click', function () {
                $http.get(baseUrl + '/public/partials/modal.html')
                    .success(function (html) {
                        $('body').append($compile(html)(scope));
                    });
            });
            
        }
    };
});



