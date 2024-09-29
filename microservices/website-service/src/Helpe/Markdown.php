<?php

namespace App\Helper;

class Markdown
{
    public static function parse($content)
    {
        $Parsedown = new \Parsedown();
        return $Parsedown->text($content);
    }
}