<?php

namespace portfolio\helpers;

/**
 * Class StringHelper
 * @package blog\helpers
 */
class StringHelper
{
    /**
     * Вырезает строку с начала
     * @param $string
     * @param $length
     * @return string
     */
    public static function cut($string, $length): string
    {
        return substr($string, 0, $length);
    }
}