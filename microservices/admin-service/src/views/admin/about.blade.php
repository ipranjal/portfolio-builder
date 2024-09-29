@extends('admin.component.page')

@section('title', 'About')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
@section('content')


<label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">About Us (Markdown)</label>
<form method="POST" action="{{url('/about')}}" ="space-y-6" action="#">

        <div class="w-full  bg-white border border-gray-200 rounded-lg shadow">

            <textarea name="about" id="" cols="30" rows="10">{{$about->content}}</textarea>

        </div>
        <button type="submit"
            class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>

    </form>


    <script>
        var simplemde = new SimpleMDE({
            forceSync: true,
            hideIcons: ["preview", "side-by-side", "fullscreen"],
        });
    </script>

@endsection
