<?php

class Format_model extends CI_Model {

    public function segmentTitle ($title) {
        $dashPos = strrpos($title, ' - ');
        
        if ($dashPos) {
            $artist = substr($title, 0,  $dashPos);
            $name = substr($title, $dashPos + 3, strlen($title));
            return '<a href="" class="song__artist">' . $artist . '</a><span class="song__name">' . $name . '</span>'; 
        } else {
            return '<span class="song__title__name">' . $title . '</span>';
        }
    }  

    public function parseTwitter ($text) {

        /*
        var output,
            text    = "@RayFranco is answering to @AnPel, this is a real '@username83' but this is an@email.com, and this is a @probablyfaketwitterusername",
            regex   = /(^|[^@\w])@(\w{1,15})\b/g,
            replace = '$1<a href="http://twitter.com/$2">@$2</a>';

        */

        $replaced = preg_replace_callback(
            '/@(\w{1,15})\b/', 
            function ($matches) {    
                // var_dump($matches);
                return '<a href="http://twitter.com/' . $matches[1] . '">' . $matches[0] . '</a>';
            }, 
            $text
        );
        return $replaced;
    }
}