<?php

function pre_print($value, Bool $exit = true)
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";
    if ($exit) {
        exit();
    }
}