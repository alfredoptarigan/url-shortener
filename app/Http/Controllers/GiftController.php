<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gift;
use Carbon\Carbon;
use App\Models\ClaimGift;
use RealRashid\SweetAlert\Facades\Alert;

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

        $history = $user->claimgift->where('gift_id', '=', $gift->id)->first();

        if ($history) {
            return "Anda sudah pernah mengambil hadiah ini sebelumnya !";
        }


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
            Alert::success('Premium Package', 'Paket Premium Berhasil Ditambahkan!');
            return redirect()->back();
        } elseif ($user->remaining_package !== null) {
            $remainingPremiumPackage = $user->remaining_package;
            $premiumRenew = Carbon::parse($remainingPremiumPackage)->addDay($gift->package)->toDateTimeString();
            $user->remaining_package = $premiumRenew;
            $user->package = 'premium';
            $user->save();
            // Tambah History Claim Gift
            ClaimGift::create([
                'gift_name' => $gift->title,
                'user_id' => $user->id,
                'gift_id' => $gift->id,
                'claim_at' => Carbon::now()->toDateTimeString()
            ]);
            Alert::success('Premium Package', 'Paket Premium Berhasil Ditambahkan!');
            return redirect()->back();
        }
    }
}
