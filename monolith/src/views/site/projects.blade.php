@extends('site.component.page')

@section('title', 'Projects')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 content">
    @foreach($projects as $project)
        @include('site.component.project', ['project' => $project])
    @endforeach
</div>


    
@endsection