@extends('layouts.app')

@section('content')
<div class="flex-1 p-5">
       <h1 class="text-2xl font-bold p-4">Branches</h1>

        @if(session('success'))
            <p class="text-green-500 bg-green-100 p-3 rounded-md">{{ session('success') }}</p>
        @endif

        @if(auth()->user()->hasRole('admin'))
            <div class="mb-4">
                <a href="{{ route('branches.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">+ Add New Branch</a>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg overflow-hidden shadow-md">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left">Branch Name</th>
                        <th class="px-4 py-3 text-left">Location</th>
                        @if(auth()->user()->hasRole('admin'))
                            <th class="px-4 py-3 text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-300">
                    @foreach ($branches as $branch)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-3 font-semibold">{{ $branch->name }}</td>
                            <td class="px-4 py-3">{{ $branch->location }}</td>
                            
                            @if(auth()->user()->hasRole('admin'))
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ route('branches.edit', $branch->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-700">Edit</a>
                                    <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-700">Delete</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
