<?php

namespace app\Helpers;

/**
 * Created by PhpStorm.
 * User: Donne
 * Date: 3-6-2016
 * Time: 15:30
 */
class TextHelper
{
    public static function create_teaser($text)
    {
        $text = strip_tags($text);
        $text = implode(' ', array_slice(explode(' ', $text), 0, 130));
        return $text;
    }
}