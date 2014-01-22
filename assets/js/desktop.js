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

function onPlayerStateEnded(event) {
    if (event.data == YT.PlayerState.ENDED) {
        autoplay();
    }
}

function onPlayerReady(event) {
    event.target.playVideo();
}

function playerEvents(event) {
    if (event.data == YT.PlayerState.PLAYING) {

        $('#play').children('i').removeClass().addClass('icon-pause');
        
        setInfo();

        var progress = setInterval(function() {
            $('#playing-time').text(songProgress());
        }, 1000);


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

        }

        if ($nextSong.nextAll('.youtube').first().length == 0) {

            var $this = $('#previous-posts');
            var offset = parseInt($this.attr('data-offset'));
            var data = 'offset='+offset;

            $this.html('<span class="icon-spinner icon-spin"></span> Loading');

            $.ajax({
                type: 'POST',
                url: paginationUrl,
                data: data,
                success: function() {
                    ////console.log(data);
                }
            }).done(function(html) {
                $('#playlist').append(html);
                $this.parent().remove();
                pagination();
            });

        }

    } else if (event.data == YT.PlayerState.PAUSED){

        $('#play').children('i').removeClass().addClass('icon-play');

        clearInterval(progress);

    } else {

        $('#play').children('i').removeClass().addClass('icon-bolt');
        $('#title').text('Loading... | Channel 599');

    }
}

function setInfo() {

    var songTitle = $('.playing h2 a').text();
    var songImg = $('.playing img').attr('src');

    $('#title').text(songTitle + ' | Channel 599');
    $('#currently-playing').removeClass('dashed').children('img').attr('src', songImg);
    $('#playing-title').text(songTitle);

}

function calculateTime(time) {

    var minutes = Math.floor(time / 60);
    var seconds = time - minutes * 60;

    if (seconds < 10) {
        seconds = '0' + seconds;
    }

    return minutes + ':' +seconds;

}

var progress;
function songProgress() {

    var time = calculateTime(Math.round(player.getCurrentTime()));
    var length = calculateTime(Math.round(player.getDuration()));
    var string = time + ' / ' + length;

    return string;
    
    ////console.log(string);

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
            $('#play').children('i').removeClass().addClass('icon-bolt');
            createYTPlayer(post_media);
        } else {
            $('#play').children('i').removeClass().addClass('icon-ban-circle');
            SC.oEmbed(post_media, {auto_play: true}, $('#player').get(0));
        }

        $.scrollTo('.playing', 500, {offset:-79} );
        $('#menu, #wrap').removeClass('open-menu');
        
    });

    $('#previous-posts').click(function(){

        var $this = $(this);
        var offset = parseInt($this.attr('data-offset'));
        var data = 'offset='+offset;

        $this.html('<span class="icon-spinner icon-spin"></span> Loading');

        $.ajax({
            type: 'POST',
            url: paginationUrl,
            data: data,
            success: function() {
                //console.log(data);
            }
        }).done(function(html) {
            $('#playlist').append(html);
            $this.parent().remove();
            pagination();
        });

    });

    $('.social button').click(function(){

        var $this = $(this);
        var miniUrl = $this.parents('.post').attr('data-mini-url');
        var title = $this.parents('.post').attr('data-song-title');
        var sanitized = title.replace('&', 'and');
        var url = 'ch599.com/'+miniUrl;
        var encoded_url = 'http%3A%2F%2Fwww.ch599.com%2F'+miniUrl;

        var width  = 575,
            height = 400,
            left   = ($(window).width()  - width)  / 2,
            top    = ($(window).height() - height) / 2,
            opts   = 'status=1' +
                     ',width='  + width  +
                     ',height=' + height +
                     ',top='    + top    +
                     ',left='   + left;
        
        if ( $this.children('i').hasClass('icon-twitter') ) {

            window.open('http://twitter.com/intent/tweet?url='+encoded_url+'&text=Check%20out%20'+sanitized+'%20at&via=channel599', 'twitter', opts);

        } else if ( $this.children('i').hasClass('icon-facebook') ) {

            window.open('https://www.facebook.com/sharer/sharer.php?u='+url, 'facebook', opts);

        } else {
            window.prompt ("Copy to clipboard: Ctrl+C, Enter", url);
        }

        return false;
        
    });

}

function autoplay() {

    var $playing = $('.post.playing');

    if ($('#shuffle').hasClass('on')) {

        var type = 'shuffle';

    } else if ($('#shuffle').hasClass('good')) {

        var type = 'good';

    } else {

        var type = $playing.attr('data-post-id');

    }

    var data = 'autoplay=' + type;

    $.ajax({

        type: 'POST',
        url: autoplayUrl,
        data: data,

        success: function() {
            //console.log(data);
        },

        error: function() {
            //console.log('error');
        }

    }).done(function(html) {

        $('#title').text('Loading... | Channel 599');
        $playing.remove();
        $('#related').remove();

        $('#topbar').after(html);

        setTimeout(function(){

            $('.fade-in').removeClass('fade-in');

        }, 300);
        pagination();
        $('#menu, #wrap').removeClass('open-menu');
        
    });

}

$(function(){

    // SECRET CODE
    var kkeys = [], konami = '71,79,79,68';
    $(document).keydown(function(e) {

        kkeys.push( e.keyCode );

        if ( kkeys.toString().indexOf( konami ) >= 0 ){

            $(document).unbind('keydown', arguments.callee);
            
            $('#shuffle').removeClass('on').removeClass('off').addClass('good').children('span').text('Good...');

        }
    });

    $('#show-more').click(function(){

        if ($('.expand').hasClass('open')) {

            $('.expand').removeClass('open');
            $('#show-more span').text('More');
            $('#show-more i').removeClass('icon-minus').addClass('icon-plus');

        } else {

            $('.expand').addClass('open');
            $('#show-more span').text('Less');
            $('#show-more i').removeClass('icon-plus').addClass('icon-minus');

        }


    });

    setTimeout(function(){

        $('.fade-in').removeClass('fade-in').addClass('transition');

    }, 300);

    $('.media img').lazyload();

    $('#open-menu').click(function(){

        $(this).toggleClass('active');

        $('#menu, #wrap').toggleClass('open-menu');

        if ($(this).hasClass('active')) {

            $(this).children('i').removeClass().addClass('icon-remove');
            $('body').removeClass('no-scroll');
            $('#open-search').removeClass('active').children('i').removeClass().addClass('icon-search');
            $('#search').hide();

        } else {

            $(this).children('i').removeClass().addClass('icon-reorder');

        }

    });

     $('#open-search').click(function(){

        $this = $(this);

        if ($this.hasClass('active')) {

            $this.removeClass('active');
            $('body').removeClass('no-scroll');
            $('#search').fadeOut();
            $this.children('i').removeClass().addClass('icon-search');

        } else {

            $this.addClass('active');
            $('body').addClass('no-scroll');
            $('#search').fadeIn();
            $this.children('i').removeClass().addClass('icon-remove');

            $('#menu, #wrap').removeClass('open-menu');
            $('#open-menu').removeClass('active').children('i').removeClass().addClass('icon-reorder');
            $('#search input').focus();

        }

    });

    $('#currently-playing').click(function(){

        $.scrollTo('.playing', 500, {offset:-79} );

    });

    $('#currently-playing').hover(function(){

        $('#currently-playing-info').fadeToggle(300);

    });

    $('.toggle').click(function(){
        
        $this = $(this);

        $this.removeClass('good');

        if ($this.hasClass('on')) {

            $this.removeClass('on').addClass('off');

            $this.children('span').text('Off');

        } else {

            $this.removeClass('off').addClass('on');

            $this.children('span').text('On');

        }

        if ($this.is('#lights') && $this.hasClass('on')) {

            $('body').removeClass('lights-down');

        } else if ($this.is('#lights')) {

            $('body').addClass('lights-down');

        }

    });

    $('#next-single').click(function(){

        autoplay();

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

            var $post = $('.post').first();
            var $media = $post.find('.media');
            var post_media = $post.attr('id');
            var $newPlayer = $('<div id="player"></div>');

            $post.addClass('playing');
            $('.post').not($post).removeClass('playing');
            $media.prepend($newPlayer);
            createYTPlayer(post_media);

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

            $.scrollTo('.playing', 500, {offset:-79} );
            //$('#menu, #wrap').removeClass('open-menu');

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

            $.scrollTo('.playing', 500, {offset:-79} );
            //$('#menu, #wrap').removeClass('open-menu');
            
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
            $('#play').children('i').removeClass().addClass('icon-bolt');
            createYTPlayer(post_media);
        } else {
            $('#play').children('i').removeClass().addClass('icon-ban-circle');
            SC.oEmbed(post_media, {auto_play: true}, $('#player').get(0));
        }

        $.scrollTo('.playing', 500, {offset:-79} );
        $('#menu, #wrap').removeClass('open-menu');
        
    });

    $('.social button').click(function(){

        var $this = $(this);
        var miniUrl = $this.parents('.post').attr('data-mini-url');
        var title = $this.parents('.post').attr('data-song-title');
        var sanitized = title.replace('&', 'and');
        var url = 'ch599.com/'+miniUrl;
        var encoded_url = 'http%3A%2F%2Fwww.ch599.com%2F'+miniUrl;

        var width  = 575,
            height = 400,
            left   = ($(window).width()  - width)  / 2,
            top    = ($(window).height() - height) / 2,
            opts   = 'status=1' +
                     ',width='  + width  +
                     ',height=' + height +
                     ',top='    + top    +
                     ',left='   + left;
        
        if ( $this.children('i').hasClass('icon-twitter') ) {

            window.open('http://twitter.com/intent/tweet?url='+encoded_url+'&text=Check%20out%20'+sanitized+'%20at&via=channel599', 'twitter', opts);

        } else if ( $this.children('i').hasClass('icon-facebook') ) {

            window.open('https://www.facebook.com/sharer/sharer.php?u='+url, 'facebook', opts);

        } else {
            window.prompt ("Copy to clipboard: Ctrl+C, Enter", url);
        }

        return false;
        
    });

    $('#previous-posts').click(function(){

        var $this = $(this);
        var offset = parseInt($this.attr('data-offset'));
        var data = 'offset='+offset;

        $this.html('<span class="icon-spinner icon-spin"></span> Loading');

        $.ajax({
            type: 'POST',
            url: paginationUrl,
            data: data,
            success: function() {
                ////console.log(data);
            }
        }).done(function(html) {
            $('#playlist').append(html);
            $this.parent().remove();
            pagination();
        });

    });

});