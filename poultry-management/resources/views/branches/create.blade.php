@extends('layouts.app')

@section('content')
<div class="flex-1 p-5">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Add New Branch</h1>

    <form action="{{ route('branches.store') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Branch Name -->
        <div>
            <label class="block text-gray-700 font-semibold">Branch Name</label>
            <input type="text" name="name" required class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-200">
        </div>

        <!-- Location -->
        <div>
            <label class="block text-gray-700 font-semibold">Location</label>
            <input type="text" name="location" class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-200">
        </div>

        <!-- Submit Button -->
        <div class="mt-4">
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-700">
                Save Branch
            </button>
        </div>
    </form>
</div>
@endsection
