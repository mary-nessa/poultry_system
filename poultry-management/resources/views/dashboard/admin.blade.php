@extends('layouts.app')

@section('content')
<div class="flex-1 p-5">
    <h1 class="text-2xl font-bold">Admin Dashboard</h1>
    <div class="grid grid-cols-3 gap-4">
        <div class="p-4 bg-blue-200 rounded">Total Branches: {{ $totalBranches }}</div>
        <div class="p-4 bg-green-200 rounded">Total Sales: UGX {{ number_format($totalSales) }}</div>
        <div class="p-4 bg-red-200 rounded">Total Expenses: UGX {{ number_format($totalExpenses) }}</div>
        <div class="p-4 bg-yellow-200 rounded">Total Eggs Collected: {{ $totalEggsCollected }}</div>
        <div class="p-4 bg-purple-200 rounded">Total Hen Stock: {{ $totalHenStock }}</div>
    </div>
</div>
@endsection
