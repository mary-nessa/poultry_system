@extends('layouts.app')

@section('content')
<div class="flex-1 p-5">
    <h1 class="text-2xl font-bold p-3">Egg Sales Report</h1>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-300 rounded-lg overflow-hidden shadow-md">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Sale Type</th>
                    <th class="px-4 py-3 text-left">Quantity</th>
                    <th class="px-4 py-3 text-left">Total Price</th>
                    <th class="px-4 py-3 text-left">Branch</th>
                    <th class="px-4 py-3 text-left">Recorded By</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-300">
                @foreach ($eggSales as $sale)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</td>
                        <td class="px-4 py-3">{{ ucfirst($sale->sale_type) }}</td>
                        <td class="px-4 py-3">{{ $sale->quantity }}</td>
                        <td class="px-4 py-3 font-bold text-green-600">{{ number_format($sale->total_price) }} UGX</td>
                        <td class="px-4 py-3">{{ $sale->branch->name ?? 'N/A' }}</td>
                        <td class="px-4 py-3">{{ $sale->user->name ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <p class="text-xl font-bold mt-4">Total Revenue: 
        <span class="text-green-500">{{ number_format($totalEggSales) }} UGX</span>
    </p>
</div>
@endsection
