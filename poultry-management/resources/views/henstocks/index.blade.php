@extends('layouts.app')

@section('content')
<div class="flex-1 p-5">
    <h1 class="text-2xl font-bold p-3" >Hen Stock</h1>

    <!-- ✅ Add Hen Stock Button -->
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('manager') || auth()->user()->hasRole('worker'))
        <div class="mb-4">
            <a href="{{ route('henstocks.create') }}" class="px-4 py-2 bg-green-500 text-white rounded">+ Add Hen Stock</a>
        </div>
    @endif

    @if(session('success'))
        <p class="text-green-500">{{ session('success') }}</p>
    @endif

    <table class="w-full border">
        <tr>
            <th class="border p-2">Breed</th>
            <th class="border p-2">Quantity</th>
            <th class="border p-2">Age (Weeks)</th>
            <th class="border p-2">Mortality</th>
            <th class="border p-2">Branch</th>
        </tr>
        @foreach ($henStocks as $henStock)
            <tr>
                <td class="border p-2">{{ $henStock->breed }}</td>
                <td class="border p-2">{{ $henStock->quantity }}</td>
                <td class="border p-2">{{ $henStock->age_weeks }}</td>
                <td class="border p-2 text-red-500">{{ $henStock->mortality }}</td>
                <td class="border p-2">{{ $henStock->branch->name ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </table>
</div>
    
@endsection
