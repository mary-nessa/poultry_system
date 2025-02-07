<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    @if(auth()->user()->notifications->count() > 0)
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
        <strong>Alerts:</strong>
        <ul>
            @foreach(auth()->user()->notifications as $notification)
                <li>{{ $notification->data['message'] }}</li>
            @endforeach
        </ul>
    </div>
@endif

    
</x-app-layout>
