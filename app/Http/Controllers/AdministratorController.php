<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Gift;

class AdministratorController extends Controller
{
    // Duunoow....
    public function index()
    {
    }

    // Create Voucher / Gift
    public function createGiftVoucher()
    {
        return view('pages.admin.gift.create');
    }

    // Store Voucher / Gift
    public function storeGiftVoucher(Request $request)
    {

        $unique_key = "";
        $request->validate([
            'title' => 'required|string',
            'unique_key' => 'string|nullable',
            "description" => "required|string",
            "package" => "required",
            "type" => "required",
            "expire_at" => "required"
        ]);

        if ($request->unique_key === "" || $request->unique_key === null) {
            $unique_key = strtoupper(Str::random(6));
        }


        $gift = Gift::create([
            'title' => $request->title,
            "user_id" => auth()->user()->id,
            "unique_key" => $request->unique_key === null || "" ? $unique_key : $request->unique_key,
            "description" => $request->description,
            "package" => $request->package,
            "type" => $request->type,
            "expire_at" => $request->expire_at
        ]);



        Alert::success('Administrator', 'Gift Berhasil Dibuat!');
        return redirect()->back();
    }
}
