@extends('layouts.app')
@section('content')
<div class="container mx-auto">
    <div class="bg-white p-5 rounded shadow-sm w-full mt-5">
        <h5 class="text-xl font-medium">Create Your Gift Here !</h5>
        <p class="text-sm leading-relaxed mb-5">Menu ini khusus untuk Administrator, Anda bisa membuat Gift untuk member
            premium ataupun free. Gift yang dibuat jangan sampai duplikat ya !</p>
        @if (Session::has('success'))
        @endif
        <form action="{{ route('admin.gifts.store') }}" method="POST">
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
                <x-label for="unique_key" :value="__('Unique Key (Opsional Kosong = Random)')" />

                <x-input id="unique_key" class="block mt-1 w-full" type="text" name="unique_key"
                    :value="old('unique_key')" autofocus />
                @error('unique_key')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2">
                <x-label for="description" :value="__('Description')" />
                <textarea name="description" id="" rows="2"
                    class="w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                @error('description')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2">
                <x-label for="package" :value="__('Package')" />
                <select name="package" id="package" class="block w-full rounded">
                    <option value="1" selected>1 Day</option>
                    <option value="3">3 Day</option>
                    <option value="5">5 Day</option>
                    <option value="7">7 Day</option>
                </select>
                @error('package')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2">
                <x-label for="type" :value="__('Type Gift')" />
                <select name="type" id="type" class="block w-full rounded">
                    <option value="free" selected>Free User</option>
                    <option value="all">All User (Free & Premium)</option>
                    <option value="premium">Premium User</option>
                </select>
                @error('type')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-2">
                <x-label for="expire_at" :value="__('Expire Gift')" />
                <x-input id="expire" class="block mt-1 w-full" type="text" name="expire_at" :value="old('expire_at')"
                    autofocus />
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
@push('custom-js')
<script>
    $("#expire").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    })
</script>
@endpush
