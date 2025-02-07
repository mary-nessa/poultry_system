@extends('layouts.app')

@section('content')
<div class="flex-1 p-5">
    <h1 class="text-2xl font-bold mb-6">Add Egg Collection</h1>

    <form method="POST" action="{{ route('eggcollections.store') }}" class="max-w-xl mx-auto p-6 border border-gray-200 rounded-lg shadow-lg">
        @csrf

        <div class="mb-4">
            <label for="date" class="block text-sm font-medium text-gray-700">Date:</label>
            <input type="date" name="date" id="date" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="mb-4">
            <label for="total_collected" class="block text-sm font-medium text-gray-700">Total Collected:</label>
            <input type="number" name="total_collected" id="total_collected" required min="0" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="mb-4">
            <label for="breakages" class="block text-sm font-medium text-gray-700">Breakages:</label>
            <input type="number" name="breakages" id="breakages" value="0" min="0" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="mb-4">
            <label for="losses" class="block text-sm font-medium text-gray-700">Losses:</label>
            <input type="number" name="losses" id="losses" value="0" min="0" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="mb-4">
            <label for="transferred" class="block text-sm font-medium text-gray-700">Transferred:</label>
            <input type="number" name="transferred" id="transferred" value="0" min="0" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
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
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        @endif

        <button type="submit" class="w-full mt-4 py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Save Egg Collection</button>
    </form>
</div>
@endsection
