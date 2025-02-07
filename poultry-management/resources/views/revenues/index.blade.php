@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Revenue Report</h1>

    <!-- ✅ Filter Form -->
    <form method="GET" class="mb-6 flex space-x-4">
        <input type="date" name="start_date" value="{{ request('start_date') }}" class="border p-2 rounded">
        <input type="date" name="end_date" value="{{ request('end_date') }}" class="border p-2 rounded">
        
        <select name="product_type" class="border p-2 rounded">
            <option value="">All Products</option>
            <option value="eggs" {{ request('product_type') == 'eggs' ? 'selected' : '' }}>Egg Sales</option>
            <option value="hens" {{ request('product_type') == 'hens' ? 'selected' : '' }}>Hen Sales</option>
            <option value="other" {{ request('product_type') == 'other' ? 'selected' : '' }}>Other</option>
        </select>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <!-- ✅ Revenue Table -->
    <table class="w-full border border-gray-300 rounded-lg overflow-hidden shadow-md">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-6 py-3 text-left">Date</th>
                <th class="px-6 py-3 text-left">Product Type</th>
                <th class="px-6 py-3 text-left">Quantity</th>
                <th class="px-6 py-3 text-left">Price Per Unit (UGX)</th>
                <th class="px-6 py-3 text-left">Total Revenue (UGX)</th>
                <th class="px-6 py-3 text-left">Branch</th>
            </tr>
        </thead>
        <tbody class="text-gray-700 divide-y divide-gray-200">
            @foreach ($revenues as $revenue)
                <tr class="hover:bg-gray-100 transition duration-200">
                    <td class="px-6 py-3">{{ \Carbon\Carbon::parse($revenue->sale_date)->format('d M Y') }}</td>
                    <td class="px-6 py-3">{{ ucfirst($revenue->product_type) }}</td>
                    <td class="px-6 py-3">{{ $revenue->quantity }}</td>
                    <td class="px-6 py-3 font-bold">{{ number_format($revenue->price_per_unit) }}</td>
                    <td class="px-6 py-3 font-bold text-green-700">{{ number_format($revenue->total_revenue) }}</td>
                    <td class="px-6 py-3">{{ $revenue->branch->name ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ✅ Total Revenue -->
    <p class="text-xl font-bold mt-6">Total Revenue: <span class="text-green-600">UGX {{ number_format($totalRevenue) }}</span></p>
</div>
@endsection
