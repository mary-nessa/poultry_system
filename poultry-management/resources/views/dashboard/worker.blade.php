@extends('layouts.app')

@section('content')
<div class="flex-1 p-5">
    <h1 class="text-2xl font-bold">Worker Dashboard</h1>
    <div class="grid grid-cols-2 gap-4">
        <div class="p-4 bg-yellow-200 rounded">My Egg Collections: {{ $totalEggsCollected }}</div>
        <div class="p-4 bg-green-200 rounded">My Sales: UGX {{ number_format($totalSales) }}</div>
    </div>
@endsection
