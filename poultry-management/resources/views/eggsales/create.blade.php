@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold">Record Egg Sale</h1>

    <form method="POST" action="{{ route('eggsales.store') }}">
        @csrf

        <label>Date:</label>
        <input type="date" name="date" required>

        <label>Sale Type:</label>
        <select name="sale_type" required>
            <option value="single">Single Egg</option>
            <option value="half_tray">Half Tray</option>
            <option value="full_tray">Full Tray</option>
            <option value="bulk">Bulk Sale</option>
        </select>

        <label>Quantity:</label>
        <input type="number" name="quantity" required min="1">

        <label>Price Per Unit:</label>
        <input type="number" name="price_per_unit" required min="0" step="0.01">

        <button type="submit">Save Sale</button>
    </form>
@endsection
