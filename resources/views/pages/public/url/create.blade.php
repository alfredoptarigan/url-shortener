@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="bg-white p-5 rounded shadow-sm w-full mt-5">
        <h5 class="text-xl font-medium">Shortener Your URL Link Here !</h5>
        <p class="text-sm leading-relaxed mb-5">Membuat Link yang dimasukkan lebih rapi dan mudah dibuka oleh pengguna,
            silahkan masukkan link yang ingin dirapikan :)</p>

        @if (Session::has('success'))
        <h5 class="text-sm font-medium">Hasil URL : </h5>
        <div class="bg-green-300 p-5 rounded w-full mt-3 mb-3 text-gray-700">
            <a href="http://url-shortener.test/r/{{ Session::get('success') }}" target="_blank"
                class="hover:text-gray-900">
                http://url-shortener.test/r/{{ Session::get('success') }}
            </a>
        </div>
        @endif
        <form action="{{ route('public.url.post') }}" method="POST">
            @csrf
            <!-- RAW URL -->
            <div>
                <x-label for="title" :value="__('Title')" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"
                    autofocus />

                @error('title')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2">
                <x-label for="url_raw" :value="__('URL Raw')" />

                <x-input id="url_raw" class="block mt-1 w-full" type="text" name="url_raw" :value="old('url_raw')"
                    autofocus />
                @error('url_raw')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2">
                <x-label for="expire_at" :value="__('Expire Link')" />
                <select name="expire_at" id="expire_at" class="block w-full rounded">
                    <option value="1" selected>1 Day</option>
                    <option value="3">3 Day</option>
                    <option value="5">5 Day</option>
                    <option value="7">7 Day</option>
                    @if (auth()->user()->package === 'premium')
                    <option value="lifetime" class="font-medium text-gray-800">Lifetime</option>
                    @endif
                </select>
                @error('expire_at')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <button class="bg-blue-500 py-2 px-5 hover:bg-blue-600 focus:outline-none rounded text-white mt-5">Submit
            </button>
        </form>
    </div>
</div>
@endsection
