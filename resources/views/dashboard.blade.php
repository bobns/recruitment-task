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
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>Welcome : <span class="font-semibold">{{$user->name}}</span></p>
                    <p>Your role is: <span class="font-semibold">{{$user->role->name}}</span> </p>
                    @if ($user->role->name === 'Administrator')
                    <p>You can read, create, edit and delete resources </p>
                    @elseif ($user->role->name === 'Moderator')
                    <p>You can read, create and edit own resources</p>
                    @elseif ($user->role->name === 'Reader')
                    <p>You can only read resources</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
