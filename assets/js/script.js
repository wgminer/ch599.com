function createYTPlayer(vidID){
    player = new YT.Player('player', {
        videoId: vidID,
        playerVars: {
            wmode: "opaque",
            showinfo: 0,
            modestbranding: 1
        },
        events: {
            'onReady': onPlayerReady,
            'onStateChange': playerEvents
        }
    });
};

function onPlayerReady(event) {
    event.target.playVideo();
}

function playerEvents(event) {
    if (event.data == YT.PlayerState.PLAYING) {

        $('#play').children('i').removeClass().addClass('icon-pause');
        
        var songTitle = $('.playing h2 a').text();
        $('#title').text(songTitle + ' | Channel 599');

    } else if (event.data == YT.PlayerState.ENDED) {
        
        var $nextSong = $('.playing').nextAll('.youtube').first();  

        if ( $nextSong.length !== 0 ) {
            var yt = $nextSong.attr('id');
            var $newPlayer = $('<div id="player"></div>');

            $('#player').remove();
            $('.playing').removeClass('playing');
            $nextSong.addClass('playing');

            $('.playing .media').prepend($newPlayer);
            createYTPlayer(yt);

            setPlayingInfo();
            $.scrollTo('.playing', 500, {offset:-80} );
        }

    } else if (event.data == YT.PlayerState.PAUSED){

        $('#play').children('i').removeClass().addClass('icon-play');

    } else {

        $('#play').children('i').removeClass().addClass('icon-spinner icon-spin');

    }
}

function setPlayingInfo(){

    if ($('.post').hasClass('playing')) {

        var id = $('.playing').attr('id');
        var title = $('.playing h2').text();
        var img = $('.playing').find('img').attr('data-original');

        $('#playing-thumbnail a').attr('href', '#'+id);
        $('#playing-thumbnail img').attr('src', img);
        $('#playing-thumbnail').attr('title', title);
        $('#html-title').text(title+' | Channeltrak');

    } else {

        var id = $('.post').attr('id');
        var title = $('.post').first().find('h2').text();
        var img = $('.post').first().find('img').attr('data-original');

        $('#playing-thumbnail a').attr('href', '#'+id);
        $('#playing-thumbnail img').attr('src', img);
        $('#playing-thumbnail').attr('title', title);

    }
}

function pagination(){

    $('.media img').lazyload();

    $('.post .media').click(function(){

        $('#panel, #wrap').removeClass('panel-open');

        var $media = $(this);
        var $post = $media.parents('.post');
        var post_media = $post.attr('id');
        var $newPlayer = $('<div id="player"></div>');

        $('#player').remove();
        $post.addClass('playing');
        $('.post').not($post).removeClass('playing');
        $media.prepend($newPlayer);

        if ($post.hasClass('youtube')) {
            $('#play').children('i').removeClass().addClass('icon-spinner icon-spin');
            createYTPlayer(post_media);
        } else {
            $('#play').children('i').removeClass().addClass('icon-ban-circle');
            SC.oEmbed(post_media, {auto_play: true}, $('#player').get(0));
        }
        
    });

}

$(function(){

    setPlayingInfo();

    $('#playing-thumbnail').click(function(){
        $.scrollTo('.playing', 500, {offset:-80} );
    });

    $('.media img').lazyload();

    $('#open-menu').click(function(){

        $('#menu, #wrap').toggleClass('open-menu');

    });

    $('#open-autoplay').click(function(){

        $('#autoplay, #wrap').toggleClass('open-autoplay');

    });

    $('.dropdown').click(function(){

        $(this).children('.sub-menu').slideToggle();

    });

    $('#play').click(function(){
        if ($('.post').hasClass('playing')) {

            if($(this).children('i').hasClass('icon-play')) {
                player.playVideo();
                $(this).children('i').removeClass().addClass('icon-pause');
            } else {
                player.pauseVideo();
                $(this).children('i').removeClass().addClass('icon-play');
            }

        } else {

            var $song = $('.post').first();
            var $this = $song.find('.media');
            var yt = $song.attr('id');
            var $newPlayer = $('<div id="player"></div>');

            $song.addClass('playing');
            $('.post').not($song).removeClass('playing');
            $this.children('.media').prepend($newPlayer);
            createYTPlayer(yt);

        }
    });

    $('#next').click(function() { 
        var $nextSong = $('.playing').nextAll('.youtube').first();        
        if ( $nextSong.length !== 0 ) {

            var yt = $nextSong.attr('id');
            var $newPlayer = $('<div id="player"></div>');

            $('#player').remove();
            $('.playing').removeClass('playing');
            $nextSong.addClass('playing');

            $('.playing .media').prepend($newPlayer);
            createYTPlayer(yt);

            setPlayingInfo();

            $.scrollTo('.playing', 500, {offset:-80} );

        }
    });

    $('#prev').click(function() { 
        var $prevSong = $('.playing').prevAll('.youtube').first();   
        if ( $prevSong.length !== 0 ) {
            
            var yt = $prevSong.attr('id');
            var $newPlayer = $('<div id="player"></div>');

            $('#player').remove();
            $('.playing').removeClass('playing');
            $prevSong.addClass('playing');

            $('.playing .media').prepend($newPlayer);
            createYTPlayer(yt);

            setPlayingInfo();

            $.scrollTo('.playing', 500, {offset:-80} );

        }
    });

    $('.post .media').click(function(){

        $('#panel, #wrap').removeClass('panel-open');

        var $media = $(this);
        var $post = $media.parents('.post');
        var post_media = $post.attr('id');
        var $newPlayer = $('<div id="player"></div>');

        $('#player').remove();
        $post.addClass('playing');
        $('.post').not($post).removeClass('playing');
        $media.prepend($newPlayer);

        if ($post.hasClass('youtube')) {
            $('#play').children('i').removeClass().addClass('icon-spinner icon-spin');
            createYTPlayer(post_media);
        } else {
            $('#play').children('i').removeClass().addClass('icon-ban-circle');
            SC.oEmbed(post_media, {auto_play: true}, $('#player').get(0));
        }
        
    });

    $('#load-previous').click(function(){

        var $this = $(this);
        $this.html('<span class="icon-spinner icon-spin"></span> Loading');
        var offset = parseInt($this.attr('data-offset'))+2;
        var data = 'offset='+offset;

        $.ajax({
            type: 'POST',
            url: ajaxUrl,
            data: data,
            success: function() {
                console.log(data);
            }
        }).done(function(html) {
            $('#loop').append(html);
            $this.hide();
            pagination();
        });

        $this.attr('data-offset', offset);

    });

    $('.form').validate({
        rules : {
            new : {
                minlength : 5
            },
            confirm : {
                minlength : 5,
                equalTo : "#password"
            }
        }
    });
});