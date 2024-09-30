@extends('shell')

@section('body')
    @include('admin.component.nav')
    @include('admin.component.sidebar')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            @include('component.alert')
            @yield('main')

        </div>
    </div>
@endsection
