<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'url_raw' => 'required|url'
        ]);

        $rand_url = Str::random(6);
        $url = Url::create([
            'user_id' => auth()->user()->id,
            'url_raw' => $request->url_raw,
            'url_convert' => $rand_url,
            'expire_at' => Carbon::now()->addDay(5)
        ]);


        return redirect()->back()->with('success', $url->url_convert);
    }

    public function findUrl($url)
    {
        $url = Url::where('url_convert', '=', $url)->first();

        return redirect($url->url_raw);
    }
}
