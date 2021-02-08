<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class UrlController extends Controller
{
    public function index()
    {
        return view('pages.public.url.menu');
    }
    public function create()
    {
        return view('pages.public.url.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'url_raw' => 'required|url'
        ]);

        $rand_url = Str::random(6);

        $url = Url::create([
            'title' => $request->title,
            'user_id' => auth()->user()->id,
            'url_raw' => $request->url_raw,
            'url_convert' => $rand_url,
            'expire_at' => $request->expire_at !== "lifetime" ? addDays($request->expire_at) : null,
            'status' => $request->expire_at === 'lifetime' ? "lifetime" : "active"
        ]);


        return redirect()->back()->with('success', $url->url_convert);
    }

    public function findUrl($url)
    {
        $url = Url::where('url_convert', '=', $url)->first();

        if (timeNowSQL() >= $url->expire_at && $url->status === 'active') {
            changeToInactive($url->id);
            return "Sudah di inactive, makasih!";
        }
        if ($url->status === 'deactive') {
            return "Link sudah expire, silahkan diperpanjang di website";
        }
        return redirect($url->url_raw);
    }

    public function myURL()
    {
        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        return view('pages.public.url.myurl', ['user' => $user]);
    }

    public function editURL($id)
    {
        $myURL = Url::findOrFail($id);
        return view('pages.public.url.edit', ['myUrl' => $myURL]);
    }

    public function updateURL($id, Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'url_raw' => 'required|url'
        ]);
        $myURL = Url::findOrFail($id);

        $myURL->update([
            'title' => $request->title,
            'url_raw' => $request->url_raw,
            'expire_at' => $request->expire_at !== "lifetime" ? addDays($request->expire_at) : null,
            'status' => $request->expire_at === 'lifetime' ? "lifetime" : "active"

        ]);

        Alert::success('My URL', 'URL berhasil di update !');
        return redirect('/my-url');
    }

    public function destroyURL($id)
    {
        $myURL = Url::findOrFail($id);
        $myURL->delete();
        Alert::success('My URL', 'URL berhasil di hapus !');
        return redirect()->back();
    }
}
