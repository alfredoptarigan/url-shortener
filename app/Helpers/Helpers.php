<?php

use Carbon\Carbon;

function remainingPackage($remainingTime)
{
    $remainingPackage = Carbon::parse($remainingTime);
    $remaining = Carbon::now()->diffInDays($remainingPackage, false);

    return $remaining;
}
