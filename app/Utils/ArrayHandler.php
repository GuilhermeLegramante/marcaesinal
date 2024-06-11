<?php

namespace App\Utils;


class ArrayHandler
{
    public static function jsonDecodeEncode($data, $hasPagination = false)
    {
        if ($hasPagination) {
            return json_decode(json_encode($data), true)['data'];
        } else {
            return json_decode(json_encode($data), true);
        }
    }
}
