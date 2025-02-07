@extends('layouts.app')

@section('content')
<div class="flex-1 p-5">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Add Expense</h1>

    <form method="POST" action="{{ route('expenses.store') }}" class="space-y-4">
        @csrf

        <!-- Branch -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Branch</label>
            <select name="branch_id" required class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-200">
                <option value="" disabled selected>Select Branch</option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Category -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Category</label>
            <input type="text" name="category" required class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-200">
        </div>

        <!-- Amount -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Amount (UGX)</label>
            <input type="text" name="amount" id="amount" required class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-200" oninput="formatAmount(this)">
            <input type="hidden" name="amount_raw" id="amount_raw"> <!-- Store raw number value -->
        </div>

        <!-- Date -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Date</label>
            <input type="date" name="date" id="date" required class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-200" max="{{ date('Y-m-d') }}">
        </div>

        <!-- Description -->
        <div>
            <label class="block text-gray-700 font-semibold mb-1">Description</label>
            <textarea name="description" class="w-full mt-1 p-2 border rounded-md focus:ring focus:ring-blue-200"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="mt-4">
            <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-md shadow-md hover:bg-green-700 transition duration-300">
                Save Expense
            </button>
        </div>
    </form>
</div>

<!-- ✅ JavaScript to Format Money Input and Prevent Negative Values -->
<script>
    function formatAmount(input) {
        let rawValue = input.value.replace(/,/g, ''); // Remove commas
        if (isNaN(rawValue) || rawValue < 0) {
            input.value = '';
            document.getElementById('amount_raw').value = '';
            return;
        }

        let formattedValue = new Intl.NumberFormat().format(rawValue);
        input.value = formattedValue;
        document.getElementById('amount_raw').value = rawValue; // Store raw number
    }

    // ✅ Prevent future dates
    document.getElementById("date").setAttribute("max", new Date().toISOString().split("T")[0]);
</script>
@endsection
