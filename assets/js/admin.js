/*
 *  Character Count Plugin - jQuery plugin
 *  Dynamic character count for text areas and input fields
 *  written by Alen Grakalic    
 *  http://cssglobe.com/post/7161/jquery-plugin-simplest-twitterlike-dynamic-character-count-for-textareas
 *
 *  Copyright (c) 2009 Alen Grakalic (http://cssglobe.com)
 *  Dual licensed under the MIT (MIT-LICENSE.txt)
 *  and GPL (GPL-LICENSE.txt) licenses.
 *
 *  Built for jQuery library
 *  http://jquery.com
 *
 */
 
(function($) {

    $.fn.charCount = function(options){
      
        // default configuration properties
        var defaults = {    
            allowed: 140,       
            warning: 25,
            css: 'counter',
            counterElement: 'span',
            cssWarning: 'warning',
            cssExceeded: 'exceeded',
            counterText: ''
        }; 
            
        var options = $.extend(defaults, options); 
        
        function calculate(obj){
            var count = $(obj).val().length;
            var available = options.allowed - count;
            if(available <= options.warning && available >= 0){
                $(obj).next().addClass(options.cssWarning);
            } else {
                $(obj).next().removeClass(options.cssWarning);
            }
            if(available < 0){
                $(obj).next().addClass(options.cssExceeded);
            } else {
                $(obj).next().removeClass(options.cssExceeded);
            }
            $(obj).next().html(options.counterText + available);
        };
                
        this.each(function() {              
            $(this).after('<'+ options.counterElement +' class="' + options.css + '">'+ options.counterText +'</'+ options.counterElement +'>');
            calculate(this);
            $(this).keyup(function(){calculate(this)});
            $(this).change(function(){calculate(this)});
        });
      
    };

})(jQuery);

function authUser() {
    FB.login(checkLoginStatus, {scope:'manage_pages, publish_stream'});
}

function checkLoginStatus(response) {
    if(response && response.status == 'connected') {

        // Hide the login button
        $('#loginButton').hide();
        $('#logoutButton, form').show();
       
    }
}

function logOut() {
    FB.logout(function(response){
        if(response && response.status != 'connected') {

            $('#loginButton').show();
            $('#logoutButton, form').hide();

        }
    });
    
}

$(function(){

    $('.genre-td').each(function(){

        if ($(this).text() == ''){

            $(this).parents('tr').addClass('no-genre');

        }
    });

    $('.btn-delete').click(function(){

        $this = $(this);

        var delete_url = $this.parents('tr').attr('data-delete-url');

        $('#confirm-delete').attr('href', delete_url);

    });

    $('.btn-genre').click(function(){

        $this = $(this);

        var post_id = $this.parents('tr').attr('id');

        $('#genre-post-id').val(post_id);

    });

    $('#loginButton').click(authUser);

    $('#logoutButton').click(logOut);

    // Initialize the Facebook JavaScript SDK
    FB.init({
        appId: '509117372434371',
        xfbml: true,
        status: true,
        cookie: true,
    });

    // Check if the current user is logged in and has authorized the app
    FB.getLoginStatus(checkLoginStatus);
	
    $('input#post_media').change(function(){

        var url = $(this).val();
        var ytId = url.substr(url.indexOf('v=')+2, 11);
        var ytUrl = 'http://img.youtube.com/vi/' + url.substr(url.indexOf('v=')+2, 11) + '/hqdefault.jpg';

        $('#media_preview').attr('src', ytUrl)
    });

    $('textarea#author_bio').keyup(function(){

        var bio = $(this).val();

        $('#bio').text(bio);
    });

    $("#tweet-text").charCount({
        allowed: 140,        
        warning: 10,
        counterText: 'Characters left: '    
    });

    $('.success, .error').fadeOut(2000);

    if ($('#error-report').children('tbody').children().length > 0) {

        $('.error-report').show();

    }


});
