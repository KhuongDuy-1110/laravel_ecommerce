<?php

use Illuminate\Support\Str;

function stringLimitedHelper($data, $length)
{
    return Str::limit($data, $length);
}