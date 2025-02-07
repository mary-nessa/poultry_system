@extends('layouts.app')

@section('content')
<div class="flex-1 p-5">
    <h1 class="text-2xl font-bold p-3 text-gray-800">Egg Collection</h1>

    <!-- Add Egg Collection Button -->
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager') || auth()->user()->hasRole('worker'))
        <div class="mb-4">
            <a href="{{ route('eggcollections.create') }}" 
               class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200 inline-flex items-center gap-2 shadow-sm">
                <span class="text-lg">+</span>
                <span>Add Egg Collection</span>
            </a>
        </div>
    @endif

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-lg shadow">
        <table class="w-full border-collapse bg-white">
            <thead class="bg-black">
                <tr>
                    <th class="border-b p-3 text-left text-xs font-medium text-white uppercase tracking-wider">Date</th>
                    <th class="border-b p-3 text-left text-xs font-medium text-white uppercase tracking-wider">Total Collected</th>
                    <th class="border-b p-3 text-left text-xs font-medium text-white uppercase tracking-wider">Breakages</th>
                    <th class="border-b p-3 text-left text-xs font-medium text-white uppercase tracking-wider">Losses</th>
                    <th class="border-b p-3 text-left text-xs font-medium text-white uppercase tracking-wider">Transferred</th>
                    <th class="border-b p-3 text-left text-xs font-medium text-white uppercase tracking-wider">Branch</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($eggCollections as $collection)
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 text-sm text-gray-900">{{ $collection->date }}</td>
                        <td class="p-3 text-sm text-gray-900">{{ $collection->total_collected }}</td>
                        <td class="p-3 text-sm text-red-600 font-medium">{{ $collection->breakages }}</td>
                        <td class="p-3 text-sm text-red-600 font-medium">{{ $collection->losses }}</td>
                        <td class="p-3 text-sm text-blue-600 font-medium">{{ $collection->transferred }}</td>
                        <td class="p-3 text-sm text-gray-900">{{ $collection->branch->name ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection