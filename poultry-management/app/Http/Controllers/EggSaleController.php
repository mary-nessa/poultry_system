<?php

namespace App\Http\Controllers;

use App\Models\EggSale;
use App\Models\Branch;
use Illuminate\Http\Request;

class EggSaleController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin') || $user->hasRole('manager')) {
            $eggSales = EggSale::with('branch', 'user')->get();
        } else {
            $eggSales = EggSale::where('branch_id', $user->branch_id)->where('user_id', $user->id)->get();
        }

        return view('eggsales.index', compact('eggSales'));
    }

    public function create()
    {
        return view('eggsales.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'date' => 'required|date|before_or_equal:today', // Prevent future dates
        'sale_type' => 'required|in:single,half_tray,full_tray,bulk',
        'quantity' => 'required|integer|min:1',
        'price_per_unit' => 'required|numeric|min:0',
    ]);

    $totalPrice = $request->quantity * $request->price_per_unit;

    $eggSale = EggSale::create([
        'branch_id' => auth()->user()->branch_id,
        'user_id' => auth()->user()->id,
        'date' => $request->date,
        'sale_type' => $request->sale_type,
        'quantity' => $request->quantity,
        'price_per_unit' => $request->price_per_unit,
        'total_price' => $totalPrice,
    ]);

    // ✅ Save revenue entry
    \App\Models\Revenue::create([
        'branch_id' => auth()->user()->branch_id,
        'product_type' => 'eggs',
        'quantity' => $request->quantity,
        'price_per_unit' => $request->price_per_unit,
        'total_revenue' => $totalPrice,
        'sale_date' => $request->date,
        'description' => 'Egg sale recorded from ' . auth()->user()->name,
    ]);

    return redirect()->route('eggsales.index')->with('success', 'Sale recorded successfully.');
}

public function report(Request $request)
{
    $user = auth()->user();
    $query = EggSale::with('branch', 'user')->orderBy('date', 'desc');

    if ($user->hasRole('manager')) {
        $query->where('branch_id', $user->branch_id);
    } elseif ($user->hasRole('worker')) {
        $query->where('user_id', $user->id);
    }

    if ($request->has('branch_id') && $user->hasRole('admin')) {
        $query->where('branch_id', $request->branch_id);
    }

    $eggSales = $query->get();
    $totalEggSales = $eggSales->sum('total_price');

    return view('eggsales.report', compact('eggSales', 'totalEggSales'));
}


}
