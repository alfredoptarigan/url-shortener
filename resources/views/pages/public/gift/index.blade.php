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
            @php
            $index = 0;
            @endphp
            @foreach ($gifts->where('type','!=',checkTypeGift(auth()->user()->package)) as $gift)
            @if (checkHistoryGift($gift->id) === false )
            <div id="cardGift-{{ $index }}"
                class="bg-white  rounded shadow-md hover:shadow-xl mt-3 transition duration-200 hover:ease-in-out cursor-pointer">
                <div id="giftTime-{{ $index }}"
                    class="bg-pink-500 w-full p-2 w-20  rounded text-white overflow-hidden font-bold  text-center">
                </div>
                <div class="p-5">
                    <p class="font-medium font-merriweather text-xl">{{ $gift->title }}</p>
                    <p class="font-medium font-merriweather text-sm">{{ $gift->description }}</p>
                    <div class="mt-3">
                        <a href="/claim-gift/{{ $gift->unique_key }}"
                            class="bg-green-500 hover:bg-green-500 py-2 px-5 rounded text-white transition duration-500 hover:ease-in-out ">Claim
                            Gift
                        </a>
                    </div>
                </div>
            </div>
            @endif
            @php
            $index++;
            @endphp
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
@push('custom-js')
<script>
    @php
$index = 0;
@endphp
@foreach ($gifts->where('type','!=',checkTypeGift(auth()->user()->package)) as $gift)
@if (checkHistoryGift($gift->id) === false )
    var countDownDate{{$index}} = new Date('{{$gift->expire_at}}').getTime();
    var x{{ $index }} = setInterval(function() {
        var now = new Date().getTime();
        var distance{{ $index }} = countDownDate{{ $index }} - now;

        var days = Math.floor(distance{{$index}} / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance{{$index}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance{{$index}} % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance{{$index}} % (1000 * 60)) / 1000);

        document.getElementById("giftTime-{{ $index }}").innerHTML = days + " Hari " + hours + " Jam "  + minutes + " Menit " + seconds + " Detik ";

        if(distance{{ $index }} < 0){
            clearInterval(x{{ $index }})
            document.getElementById("cardGift-{{$index}}").style.display = "none";
        }
    },1000);
@endif
@php
$index++;
@endphp
@endforeach
</script>
@endpush
