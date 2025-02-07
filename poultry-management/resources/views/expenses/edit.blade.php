@extends('layouts.app')

@section('content')
<div class="flex-1 p-5">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Edit Expense</h1>

    <form method="POST" action="{{ route('expenses.update', $expense->id) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Category:</label>
            <input 
                type="text" 
                name="category" 
                value="{{ $expense->category }}" 
                required 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            >
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Amount:</label>
            <input 
                type="number" 
                name="amount" 
                value="{{ $expense->amount }}" 
                required 
                step="0.01"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            >
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Date:</label>
            <input 
                type="date" 
                name="date" 
                value="{{ $expense->date }}" 
                required
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
            >
        </div>

        <div class="space-y-2">
            <label class="block text-sm font-medium text-gray-700">Description:</label>
            <textarea 
                name="description" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm min-h-[100px]"
            >{{ $expense->description }}</textarea>
        </div>

        <div class="flex justify-end mt-8">
            <button 
                type="submit"
                class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors"
            >
                Update Expense
            </button>
        </div>
    </form>
</div>
@endsection