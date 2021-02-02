@extends('layouts.app')
@section('content')
<div class="container mx-auto">
    <div class="bg-white p-5 rounded shadow-sm hover:shadow-xl text-gray-800 w-full mt-5">
        <div class="flex justify-between ">
            <div class="p-3 ml-16 ">
                <p class="font-bold font-merriweather">Selamat Malam, {{ auth()->user()->name }} !</p>
                <p class="font-medium font-merriweather">Kamu bisa mengklaim hadiah harian kamu untuk mendapatkan gratis
                    Premium Package selama 7 hari, segera klaim sekarang. </p>
                <p class="font-medium font-merriweather text-blue-500">Hadiah akan direset setiap satu (1) minggu
                    sekali, jadi jangan lupa klaim hadiah Premium gratis sekarang ! Hadiah gratis ini hanya berlaku
                    untuk Free User saja !
                </p>
                <div class="mt-3">
                    <a href="#"
                        class="bg-blue-500 px-4 py-2 text-white font-merriweather hover:bg-blue-600 rounded shadow-sm hover:shadow-xl transition duration-300 hover:ease-in-out">
                        Claim Gift
                    </a>
                </div>
            </div>
            <div class="p-3 mr-16">
                <img src="{{asset('/images/shortener-illustration.png') }}" alt="Shortener URL" width="250">
            </div>

        </div>
    </div>
    <div class="grid lg:grid-cols-3 md:grid-cols-2 md:grid-row-6 gap-4 mt-5">
        <x-card type="green">
            @slot('header')
            Total Link Active
            @endslot

            @slot('subtitle')
            Link Active
            @endslot

            @slot('number')
            {{ totalActiveLink() }}
            @endslot
        </x-card>
        <x-card type="blue">
            @slot('header')
            Total Link Lifetime
            @endslot

            @slot('subtitle')
            Link Lifetime
            @endslot

            @slot('number')
            {{ totalLifetimeLink() }}
            @endslot
        </x-card>
        <x-card type="red">
            @slot('header')
            Total Link Deactive
            @endslot

            @slot('subtitle')
            Link Oudated
            @endslot

            @slot('number')
            {{ totalDeactiveLink() }}
            @endslot
        </x-card>
    </div>
</div>
@endsection
