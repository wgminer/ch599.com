function pagination(){

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
                console.log(data);
            }
        }).done(function(html) {
            $('#playlist').append(html);
            $this.parent().remove();
            pagination();
        });

    });

}

$(function(){

    Deferred.installInto(Zepto)
    
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
                console.log(data);
            }
        }).done(function(html) {
            $('#playlist').append(html);
            $this.parent().remove();
            pagination();
        });

    });

});