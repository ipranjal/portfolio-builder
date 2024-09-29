@extends('admin.component.page')

@section('title', 'Projects')
@section('content')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

    <form action="{{url('/admin/projects')}}" method="POST" enctype="multipart/form-data" class="space-y-6" action="#">
        <h5 class="text-xl font-medium text-gray-900 ">Details of Project</h5>

        <div>

            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Header Image</label>
            <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                id="file_input"  name="img" type="file">

        </div>

        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input type="name" name="title" id="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                placeholder="link for more info..." required />
        </div>

        <div>

            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Summary</label>
            <textarea id="message" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Short summary of project..." name="summary" required></textarea>

        </div>
        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">link</label>


        <div class="w-full bg-white border border-gray-200 rounded-lg shadow ">

            <input type="name" name="link" id="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                placeholder="site name"/>
        </div>


            <button type="submit"
                class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>

    </form>
   

@endsection


