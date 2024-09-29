@extends('shell')

@section('body')
@include('site.component.nav')
@include('site.component.sidebar')
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 ">
        @yield('main')

    </div>
</div>
@endsection