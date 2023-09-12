<?php

if (! function_exists('divisionNum')) {

    function divisionNum($numerator, $denominator)
    {
        return $denominator == 0 ? 0 : ($numerator / $denominator);
    }

}