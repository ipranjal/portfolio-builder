@extends('site.component.page')

@section('title', 'About Me')
   
@section('content')
<style>
    .parsedown h1 {
        font-size: 2.25rem;
        line-height: 2.5rem;
        font-weight: 700;
        color: #fff;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .parsedown h2{
        font-size: 1.875rem;
        line-height: 2.25rem;
        font-weight: 700;
        color: #fff;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .parsedown h3 {
        font-size: 1.5rem;
        line-height: 2rem;
        font-weight: 700;
        color: #fff;
        margin-top: 1rem;
        margin-bottom: 1rem;
    }

    .parsedown p {
        margin-bottom: 0.75rem;
        color: #9CA3AF; 
    }

    .parsedown ul {
        margin-top: 0.25rem;
        max-width: 28rem;
        list-style-type: disc;
        list-style-position: inside;
        color: #9CA3AF; 
    }

</style>

<div class="parsedown content">
    <div class="dark:text-white">
        {!! \App\Helper\Markdown::parse($about->content) !!}
    </div>
   

</div>

@endsection