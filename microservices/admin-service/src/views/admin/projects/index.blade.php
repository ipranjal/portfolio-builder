@extends('admin.component.page')

@section('title', 'Projects')
@section('content')


<div class="flex mb-5">
    <a href="{{url('/projects/add')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add New Project</a>
</div>


<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    summary
                </th>
                <th scope="col" class="px-6 py-3">
                    Image
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
            @foreach($projects as $project)
            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{$project->title}}
                </th>
                <td class="px-6 py-4">
                    {{$project->summary}}
                </td>
                <td class="px-6 py-4">
                    <a href="{{$project->img}}">
                        <img class="w-20 h-20 mt-2" src="{{$project->img}}" alt="Extra large avatar">
                    </a>
                </td>
                <td class="px-6 py-4">
                    <a href="{{$project->link}}">{{$project->link}}</a>
                 </td>
                

                <td class="px-6 py-4">
                    <a href="{{url('/projects/edit?id='.$project->id)}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    <a href="{{url('/projects/delete?id='.$project->id)}}" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>


@endsection
