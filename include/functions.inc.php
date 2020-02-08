<?php
function pr($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}
function zeroOrNah($number)
{
    return ($number >= 10) ? '' : '0';
}
