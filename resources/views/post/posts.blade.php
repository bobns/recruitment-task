<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(session()->has('message'))
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-300 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-green-300 border-b border-gray-200">
                    {{ session()->get('message') }}
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-gray-700 text-white font-semibold">
                            <th class="py-2 px-4 ">No.</th>
                            <th class="py-2 px-4 ">Id</th>
                            <th class="py-2 px-4">Title</th>
                            <th class="py-2 px-4 w-1/3">Categories</th>
                            <th class="py-2 px-4 w-1/3">Message</th>
                            <th class="py-2 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts ?? [] as $post)
                        <tr class="text-gray-600 h-32">
                            <td class="py-2 px-4 border-b border-r border-gray-200">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b border-r border-gray-200">{{ $post->id }}</td>
                            <td class="py-2 px-4 border-b border-r border-gray-200">{{ $post->title }}</td>
                            <td class="py-2 px-4 border-b border-r border-gray-200 ">
                                <div class="flex flex-row flex-wrap">
                                    @foreach ($post->categories as $category)
                                    <p class="bg-gray-100 px-4 py-2 mr-4 mb-3">{{$category->name}}</p>
                                    @endforeach
                                </div>

                            </td>
                            <td class="py-2 px-4 border-b border-r border-gray-200">{{ $post->message }}</td>
                            <td class="flex-wrap py-2 px-4 border-b border-r border-gray-200">
                                <div class="flex flex-row">
                                    <button class="block mr-8">
                                        <a class="underline text-lg"
                                            href="{{ route('edit-post-form', ['postId' => $post->id]) }}">Edit</a>
                                    </button>
                                    <form action="{{route('delete-post', ['postId' => $post->id])}}" method="POST">
                                        {{ method_field('DELETE') }}
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{$post->id}}">
                                        <button type="submit"
                                            class="block bg-gray-800 text-white px-4 py-1.5 rounded-lg">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
