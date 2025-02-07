@extends('layouts.app')

@section('content')
<div class="flex-1 p-5">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Egg Sales</h1>

    <!-- Add Sales Button (Only for Workers) -->
    @if(auth()->user()->hasRole('worker'))
        <div class="mb-6">
            <a href="{{ route('eggsales.create') }}" class="px-6 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700 transition duration-300">
                + Add Sale
            </a>
        </div>
    @endif

    @if(session('success'))
        <div class="mb-6 p-3 bg-green-100 text-green-700 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="px-6 py-3 text-left">Date</th>
                    <th class="px-6 py-3 text-left">Sale Type</th>
                    <th class="px-6 py-3 text-left">Quantity</th>
                    <th class="px-6 py-3 text-left">Price Per Unit</th>
                    <th class="px-6 py-3 text-left">Total Price</th>
                    <th class="px-6 py-3 text-left">Branch</th>
                    <th class="px-6 py-3 text-left">Recorded By</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-200">
                @foreach ($eggSales as $sale)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="px-6 py-3">{{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</td>
                        <td class="px-6 py-3 capitalize">{{ $sale->sale_type }}</td>
                        <td class="px-6 py-3">{{ $sale->quantity }}</td>
                        <td class="px-6 py-3 text-green-600">{{ number_format($sale->price_per_unit) }}</td>
                        <td class="px-6 py-3 font-bold text-green-700">{{ number_format($sale->total_price) }}</td>
                        <td class="px-6 py-3">{{ $sale->branch->name ?? 'N/A' }}</td>
                        <td class="px-6 py-3">{{ $sale->user->name ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
