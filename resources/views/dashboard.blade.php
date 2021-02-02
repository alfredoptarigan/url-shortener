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
