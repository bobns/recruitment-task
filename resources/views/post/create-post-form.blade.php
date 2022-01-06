<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if ($errors->any())
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-green-300 overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($errors->all() as $error)
                <div class="p-6 bg-red-300 border-b border-gray-200">
                    {{ $error }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @if (!$categories->first())
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-red-300 border-b border-gray-200">
                    You need to add category before adding a post
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-3xl mb-4 text-gray-700 font-semibold">Add new post</h2>
                    <form action="{{route('create-post')}}" method="POST" enctype="multipart/form-data"
                        class="flex flex-col sm:w-1/2">
                        @csrf
                        <label class="block font-medium text-gray-700" for="title">Post title</label>
                        <input id="title" type="text" name="title" value="{{old('value')}}"
                            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="mt-4 flex flex-col">
                            <label class="block font-medium text-gray-700">Choose categories</label>

                            <select class="form-control" name="category[]" multiple
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
                                @foreach ($categories ?? [] as $category)
                                <option value="{{$category->id}}">{{$category->name}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4 flex flex-col">
                            <label for="message" class="block font-medium text-gray-700">Post message</label>
                            <textarea
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="message" id="message" rows="10"></textarea>
                        </div>
                        <div class="self-end mt-3">
                            <x-button class="ml-4">
                                {{ __('Add post') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
