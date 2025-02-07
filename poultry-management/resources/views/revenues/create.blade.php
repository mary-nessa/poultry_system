@extends('layouts.app')

@section('content')
<div class="flex-1 p-5">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Record Revenue</h1>

    <form method="POST" action="{{ route('revenues.store') }}" class="space-y-4">
        @csrf

        @include('revenues._form')

        <!-- Submit Button -->
        <div class="mt-4">
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-700 transition duration-300">
                Save Revenue
            </button>
        </div>
    </form>
</div>
@endsection
