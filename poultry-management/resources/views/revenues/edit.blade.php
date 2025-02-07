@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Edit Revenue</h1>

    <form method="POST" action="{{ route('revenues.update', $revenue->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        @include('revenues._form')

        <!-- Submit Button -->
        <div class="mt-4">
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-700 transition duration-300">
                Update Revenue
            </button>
        </div>
    </form>
</div>
@endsection
