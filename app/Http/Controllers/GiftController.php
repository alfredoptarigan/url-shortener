<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gift;
use Carbon\Carbon;
use App\Models\ClaimGift;

class GiftController extends Controller
{
    public function index()
    {
        $gifts = Gift::where('expire_at', '>=', timeNowSQL())->get();
        $history = ClaimGift::with('gift')->where('user_id', '=', auth()->user()->id)->get();
        return view('pages.public.gift.index', ['gifts' => $gifts, 'history' => $history]);
    }

    public function claim($uniqueKey)
    {
        $gift = Gift::where('unique_key', '=', $uniqueKey)->first();
        $user = auth()->user();
        if ($user->remaining_package === null) {
            // Tambah Paket Premium User
            $premiumPackage = Carbon::now()->addDay($gift->package)->toDateTimeString();
            $user->remaining_package = $premiumPackage;
            $user->package = 'premium';
            $user->save();

            // Tambah History Claim Gift
            ClaimGift::create([
                'gift_name' => $gift->title,
                'user_id' => $user->id,
                'gift_id' => $gift->id,
                'claim_at' => Carbon::now()->toDateTimeString()
            ]);
            return "Paket premium berhasil ditambahkan";
        }
    }
}
