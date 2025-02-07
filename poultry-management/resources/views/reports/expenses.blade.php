@extends('layouts.app')

@section('content')
<div class="flex-1 p-5">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Expense Reports</h1>

    <!-- ✅ Filter Form -->
    <form method="GET" class="mb-6 flex flex-wrap gap-4 bg-gray-100 p-4 rounded-md shadow">
        <div class="flex flex-col">
            <label for="start_date" class="text-gray-700 text-sm">Start Date</label>
            <input type="date" name="start_date" value="{{ request('start_date') }}" class="border p-2 rounded-md w-40">
        </div>

        <div class="flex flex-col">
            <label for="end_date" class="text-gray-700 text-sm">End Date</label>
            <input type="date" name="end_date" value="{{ request('end_date') }}" class="border p-2 rounded-md w-40">
        </div>

        <div class="flex flex-col">
            <label for="category" class="text-gray-700 text-sm">Category</label>
            <select name="category" class="border p-2 rounded-md w-40">
                <option value="">All Categories</option>
                <option value="Feed" {{ request('category') == 'Feed' ? 'selected' : '' }}>Feed</option>
                <option value="Labor" {{ request('category') == 'Labor' ? 'selected' : '' }}>Labor</option>
                <option value="Medical" {{ request('category') == 'Medical' ? 'selected' : '' }}>Medical</option>
            </select>
        </div>

        @if(auth()->user()->hasRole('admin'))
            <div class="flex flex-col">
                <label for="branch_id" class="text-gray-700 text-sm">Branch</label>
                <select name="branch_id" class="border p-2 rounded-md w-40">
                    <option value="">All Branches</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <div class="flex items-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md shadow-md hover:bg-blue-700">Filter</button>
        </div>
    </form>

    <!-- ✅ Expense Table -->
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 rounded-lg overflow-hidden shadow-md">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">Category</th>
                    <th class="px-4 py-3 text-left">Amount (UGX)</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Branch</th>
                    <th class="px-4 py-3 text-left">Description</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-300">
                @foreach ($expenses as $expense)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-3 font-semibold text-gray-700">{{ $expense->category }}</td>
                        <td class="px-4 py-3 font-bold text-green-600">{{ number_format($expense->amount) }}</td>
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</td>
                        <td class="px-4 py-3">{{ $expense->branch->name ?? 'N/A' }}</td>
                        <td class="px-4 py-3">{{ $expense->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- ✅ Export & Graphs Buttons -->
    <div class="flex flex-wrap gap-4 mt-6">
        <a href="{{ route('expense-reports.export.excel', request()->query()) }}" class="bg-green-500 text-white px-6 py-2 rounded-md shadow-md hover:bg-green-700">Export Excel</a>
        <a href="{{ route('expense-reports.export.pdf', request()->query()) }}" class="bg-red-500 text-white px-6 py-2 rounded-md shadow-md hover:bg-red-700">Export PDF</a>
        <a href="{{ route('expense-reports.graphs') }}" class="bg-purple-500 text-white px-6 py-2 rounded-md shadow-md hover:bg-purple-700">View Graphs</a>
    </div>

    <!-- ✅ Total Expenses -->
    <p class="text-xl font-bold mt-6 text-gray-800">Total Expenses: 
        <span class="text-red-500">UGX {{ number_format($totalExpense, 2) }}</span>
    </p>
</div>
@endsection
