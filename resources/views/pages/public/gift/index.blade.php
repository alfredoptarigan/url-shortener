@extends('layouts.app')
@section('content')
<div class="container mx-auto">
    <div class="bg-white p-5 rounded shadow-sm hover:shadow-md w-full mt-5">
        <p class="font-medium text-xl font-merriweather">Claim Gifts</p>
        <p class="font-medium text-sm leading-relaxed text-blue-700 font-merriweather cursor-pointer">Kamu bisa
            mengklaim hadiah di
            menu ini, hadiah
            yang diklaim
            hanya bisa sekali saja. Untuk hadiah harian, Kamu bisa mengklaim nya satu minggu sekali ya dan Kamu bisa
            mendapatkan paket premium selama seminggu
        </p>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 md:grid-row-6 gap-4 mt-5">
            @foreach ($gifts as $gift)
            @if (checkHistoryGift($gift->id) === false)
            <div
                class="bg-white p-5 rounded shadow-md hover:shadow-xl mt-3 transition duration-200 hover:ease-in-out cursor-pointer">
                <p class="font-medium font-merriweather text-xl">{{ $gift->title }}</p>
                <p class="font-medium font-merriweather text-sm">{{ $gift->description }}</p>
                <div class="mt-3">
                    <a href="/claim-gift/{{ $gift->unique_key }}"
                        class="bg-green-500 hover:bg-green-500 py-2 px-5 rounded text-white transition duration-500 hover:ease-in-out ">Claim
                        Gift
                    </a>
                </div>
            </div>
            @endif
            @endforeach

        </div>
    </div>
    <div class="bg-white p-5 rounded shadow-sm hover:shadow-md w-full mt-5">
        <p class="font-medium text-xl font-merriweather">History Claim Gifts</p>
        <p class="font-medium text-sm leading-relaxed text-blue-700 font-merriweather cursor-pointer">
            Kamu bisa melihat history gifts yang sudah kamu klaim sebelumnya.
        </p>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 md:grid-row-6 gap-4 mt-5">
            @foreach ($history as $hs)
            <div
                class="bg-white p-5 rounded shadow-md hover:shadow-xl mt-3 transition duration-200 hover:ease-in-out cursor-pointer">
                <p class="font-medium font-merriweather text-xl">{{ $hs->gift->title }}</p>
                <p class="font-medium font-merriweather text-sm">{{ $hs->gift->description }}</p>

            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection
