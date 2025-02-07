@extends('layouts.app')

@section('content')
<div class="flex-1 p-5">
    <h1 class="text-2xl font-bold mb-6">Add Hen Stock</h1>

    <form method="POST" action="{{ route('henstocks.store') }}" class="max-w-xl mx-auto p-6 border border-gray-200 rounded-lg shadow-lg">
        @csrf

        <div class="mb-4">
            <label for="breed" class="block text-sm font-medium text-gray-700">Breed:</label>
            <input type="text" name="breed" id="breed" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity:</label>
            <input type="number" name="quantity" id="quantity" required min="0" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="mb-4">
            <label for="age_weeks" class="block text-sm font-medium text-gray-700">Age (Weeks):</label>
            <input type="number" name="age_weeks" id="age_weeks" required min="0" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="mb-4">
            <label for="mortality" class="block text-sm font-medium text-gray-700">Mortality:</label>
            <input type="number" name="mortality" id="mortality" value="0" min="0" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        @if(auth()->user()->hasRole('admin'))
            <div class="mb-4">
                <label for="branch_id" class="block text-sm font-medium text-gray-700">Branch:</label>
                <select name="branch_id" id="branch_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
        @else
            <input type="hidden" name="branch_id" value="{{ auth()->user()->branch_id }}">
        @endif

        <button type="submit" class="w-full mt-4 py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Save Hen Stock</button>
    </form>
</div>
@endsection
