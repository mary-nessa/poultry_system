@extends('layouts.app')

@section('content')
<div class="text-l font-bold p-3">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Expenses</h1>

    @if(session('success'))
        <p class="text-green-600 bg-green-100 p-3 rounded-md">{{ session('success') }}</p>
    @endif

    <!-- ✅ Create Expense Button (Opens Modal) -->
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager') || auth()->user()->hasRole('worker'))
        <div class="mb-4">
            <button onclick="openModal()" class="px-4 py-2 bg-green-600 text-white rounded-md shadow-md hover:bg-green-700">+ Add Expense</button>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 rounded-lg overflow-hidden shadow-md">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">Category</th>
                    <th class="px-4 py-3 text-left">Amount (UGX)</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Branch</th>
                    <th class="px-4 py-3 text-left">Description</th>
                    <th class="px-4 py-3 text-center">Actions</th>
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
                        <td class="px-4 py-3 text-center">
                            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager') || auth()->user()->hasRole('worker'))
                                <a href="{{ route('expenses.edit', $expense->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-700">Edit</a>
                            @endif

                            @if(auth()->user()->hasRole('admin'))
                                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-md shadow-md hover:bg-red-700">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for Add Expense -->
<!-- Modal for Add Expense -->
<div id="addExpenseModal" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl w-11/12 md:w-1/2 lg:w-1/3 max-h-[90vh] overflow-y-auto transform transition-all duration-300 ease-in-out">
        <div class="bg-green-600 text-white px-6 py-4 rounded-t-xl">
            <h2 class="text-2xl font-semibold">Add Expense</h2>
        </div>
        
        <form method="POST" action="{{ route('expenses.store') }}" class="p-6 space-y-4">
            @csrf

            <!-- Branch -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Branch</label>
                <select name="branch_id" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="" disabled selected>Select Branch</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Category -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Category</label>
                <input type="text" name="category" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <!-- Amount -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Amount (UGX)</label>
                <input type="number" name="amount" id="amount" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" >
                {{-- <input type="hidden" name="amount_raw" id="amount_raw"> --}}
            </div>

            <!-- Date -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Date</label>
                <input type="date" name="date" id="date" required class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" max="{{ date('Y-m-d') }}">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-gray-700 font-semibold mb-2">Description</label>
                <textarea name="description" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500" rows="4"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" class="w-full bg-green-600 text-white px-4 py-3 rounded-md shadow-md hover:bg-green-700 transition duration-300 font-semibold">
                    Save Expense
                </button>
            </div>
        </form>

        <div class="px-6 pb-6">
            <button onclick="closeModal()" class="w-full bg-red-500 text-white px-4 py-3 rounded-md hover:bg-red-700 transition duration-300 font-semibold">
                Close
            </button>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('addExpenseModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('addExpenseModal').classList.add('hidden');
    }

    // Format amount input
    // function formatAmount(input) {
    //     let rawValue = input.value.replace(/,/g, ''); // Remove commas
    //     if (isNaN(rawValue) || rawValue < 0) {
    //         input.value = '';
    //         document.getElementById('amount_raw').value = '';
    //         return;
    //     }

    //     let formattedValue = new Intl.NumberFormat().format(rawValue);
    //     input.value = formattedValue;
    //     document.getElementById('amount_raw').value = rawValue; // Store raw number
    // }

    // Prevent future dates
    document.getElementById("date").setAttribute("max", new Date().toISOString().split("T")[0]);
</script>

@endsection
