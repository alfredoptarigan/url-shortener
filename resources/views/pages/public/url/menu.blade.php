@extends('layouts.app')

@section('content')
<div class="container mx-auto bg-white p-5 rounded mt-5">
    <h5 class="font-medium">User Menu</h5>
    <div class="grid lg:grid-cols-2 md:grid-cols-6 gap-4">
        <x-card-button bgCardColor="green" btnColor="blue" :url="route('public.url.create')">
            @slot('header')
            Create Shorten URL
            @endslot
        </x-card-button>
        <x-card-button bgCardColor="blue" btnColor="pink" :url="route('public.url.menu')">
            @slot('header')
            My URL Shorten
            @endslot
        </x-card-button>
    </div>
</div>
@endsection
