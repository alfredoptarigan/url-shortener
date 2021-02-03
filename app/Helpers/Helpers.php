<?php

use Carbon\Carbon;
use App\Models\Url;
use App\Models\ClaimGift;

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

function totalActiveLink()
{
    return count(auth()->user()->url->where('status', '=', 'active'));
}

function totalDeactiveLink()
{
    return count(auth()->user()->url->where('status', '=', 'deactive'));
}

function totalLifetimeLink()
{
    return count(auth()->user()->url->where('status', '=', 'lifetime'));
}


function checkHistoryGift($id)
{
    $history = ClaimGift::where([
        ['gift_id', '=', $id],
        ['user_id', '=', auth()->user()->id]
    ])->first();


    if ($history) {
        return true;
    } else {
        return false;
    }
}

function checkTypeGift($userPackage)
{
    if ($userPackage === 'free') {
        return "premium";
    } else {
        return "free";
    }
}
