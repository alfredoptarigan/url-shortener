@extends('layouts.app')
@section('content')
<div class="bg-white p-5 rounded shadow-sm hover:shadow-2xl mt-5">
    <h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">
        List URL Shorten &mdash; {{ $user->name }}
    </h1>
    <div id='recipients' class="p-8 mt-6 lg:mt-0">
        <table id="urlshorten" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>
                    <th data-priority="1">Title</th>
                    <th data-priority="2">URL</th>
                    <th data-priority="3">Unique Key</th>
                    <th data-priority="4">Status</th>
                    <th data-priority="5">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->url as $ul)
                <tr>
                    <td>{{ $ul->title }}</td>
                    <td><a href="http://url-shortener.test/r/{{ $ul->url_convert }}" target="_blank"
                            class="hover:text-blue-500 hover:font-medium transition duration-200 hover:ease-in-out">http://url-shortener.test/r/{{ $ul->url_convert }}</a>
                    </td>
                    <td>{{ $ul->url_convert }}</td>
                    <td>
                        <div class="flex">
                            @if ($ul->expire_at === null && $ul->status === 'lifetime')
                            <span class="mr-2 bg-green-500 text-white p-2 rounded  leading-none flex items-center">
                                Lifetime
                            </span>
                            @elseif($ul->expire_at !== null)

                            @if(timeNowSQL() >= $ul->expire_at )
                            @php
                            changeToInactive($ul->id);
                            @endphp
                            <span class="mr-2 bg-red-500 text-white p-2 rounded  leading-none flex items-center">
                                Inactive
                            </span>
                            @endif

                            @if ($ul->status === 'active' && timeNowSQL() <= $ul->expire_at)
                                <span class="mr-2 bg-blue-500 text-white p-2 rounded  leading-none flex items-center">
                                    Active &nbsp; <span class="font-medium"> {{ remainingPackage($ul->expire_at) }}
                                    </span>
                                </span>
                                @endif
                                @endif
                        </div>
                    </td>
                    <td>
                        <div class="flex items-center justify-start">
                            <form action="{{ route('public.url.destroy',$ul->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="mr-2 bg-red-600 text-white p-2 rounded  leading-none flex items-center">
                                    Delete
                                </button>
                            </form>
                            <a href="{{ route('public.url.edit',$ul->id) }}"
                                class="mr-2 bg-yellow-500 text-white p-2 rounded  leading-none flex items-center">
                                Edit
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>


    </div>
</div>
@endsection





@push('custom-css')
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<!--Responsive Extension Datatables CSS-->
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/custom-table.css') }}">
@endpush

@push('custom-js')
<!-- jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<!--Datatables -->
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {

        			var table = $('#urlshorten').DataTable( {
        					responsive: true
        				} )
        				.columns.adjust()
        				.responsive.recalc();
    } );
</script>
@endpush
