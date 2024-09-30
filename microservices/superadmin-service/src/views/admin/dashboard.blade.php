@extends('admin.component.page')

@section('title', 'Dashboard')
@section('content')

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Username
                    </th>
                    <th scope="col" class="px-6 py-3">
                        About
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Link
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sites as $site)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $site->title }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $site->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $site->about }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ $site->name }}.iportfolio.me">{{ $site->name }}.iportfolio.me</a>
                        </td>


                        <td class="px-6 py-4">
                            <a href="#"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    <div
        class="w-full max-w-lg p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <form method="POST" action="{{ url('/dashboard') }}" enctype="multipart/form-data" class="space-y-6"
            action="#">
            <h5 class="text-xl font-medium text-gray-900 dark:text-white">Site Settings</h5>
            <img class=" rounded-full w-40 h-40 mt-10" src="{{ $site->avatar }}" alt="Extra large avatar">

            <div>

                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Profile
                    Picture</label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="file_input" name="avatar" type="file">

            </div>
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="name" name="title" id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="site name" value="{{ $site->title }}" required />
            </div>

            <div>

                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">About
                    Summary</label>
                <textarea id="message" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Short about you..." name="about">{{ $site->about }}</textarea>

            </div>

            <div>

                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Resume</label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="file_input" name="resume" type="file">

            </div>


            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>

        </form>
    </div>

@endsection
