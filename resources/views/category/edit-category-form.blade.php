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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-3xl mb-4 text-gray-700 font-semibold">Update category</h2>
                    <form action="{{route('update-category', ['categoryId' => $category->id])}}" method="POST"
                        class="flex flex-col sm:w-1/2">
                        {{ method_field('PUT') }}
                        @csrf
                        <input type="text" name="category" value="{{old('category') ?? $category->name}}"
                            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="self-end mt-3">
                            <x-button class="ml-4">
                                {{ __('Update category') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
