@extends('layouts.app')

@section('content')
<div class="flex-1 p-5">
    <h1 class="text-2xl font-bold">Manager Dashboard</h1>
    <div class="grid grid-cols-2 gap-4">
        <div class="p-4 bg-green-200 rounded">Branch Sales: UGX {{ number_format($totalSales) }}</div>
        <div class="p-4 bg-red-200 rounded">Branch Expenses: UGX {{ number_format($totalExpenses) }}</div>
        <div class="p-4 bg-yellow-200 rounded">Eggs Collected: {{ $totalEggsCollected }}</div>
        <div class="p-4 bg-purple-200 rounded">Hen Stock: {{ $totalHenStock }}</div>
    </div>
</div>
    
@endsection
