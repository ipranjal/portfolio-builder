@extends('site.shell')

<style>
    .content{
        padding: 1.25rem; 
    }
</style>

@section('main')
<h1 class="mb-4 content text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">@yield('title')</h1>

@yield('content')
				
@endsection