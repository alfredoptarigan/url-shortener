@extends('layouts.app')
@section('content')
<div class="container mx-auto">
    <div class="grid lg:grid-cols-3 md:grid-cols-2 md:grid-row-6 gap-4 mt-5">
        <x-card type="green">
            @slot('header')
            Total Link Active
            @endslot

            @slot('subtitle')
            Link Active
            @endslot
        </x-card>
        <x-card type="red">
            @slot('header')
            Total Link Outdated
            @endslot

            @slot('subtitle')
            Link Oudated
            @endslot
        </x-card>
        <x-card type="red">
            @slot('header')
            Total Link Outdated
            @endslot

            @slot('subtitle')
            Link Oudated
            @endslot
        </x-card>

    </div>
</div>
@endsection
