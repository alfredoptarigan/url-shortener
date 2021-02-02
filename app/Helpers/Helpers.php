<?php

use Carbon\Carbon;
use App\Models\Url;

function remainingPackage($remainingTime)
{
    $remainingPackage = Carbon::parse($remainingTime);
    $remaining = Carbon::now()->diffInDays($remainingPackage, false);

    if ($remaining === 0) {
        return Carbon::now()->diffInHours($remainingPackage, false) . " Hours ";
    }

    return $remaining . " Day ";
}

function addDays($day)
{
    $nextDay = Carbon::now()->addDay($day)->toDateTimeString();

    return $nextDay;
}

function timeNowSQL()
{
    return Carbon::now()->toDateTimeString();
}

function changeToInactive($id)
{
    $url = Url::FindOrFail($id);
    $url->status = 'deactive';
    return $url->save();
}
