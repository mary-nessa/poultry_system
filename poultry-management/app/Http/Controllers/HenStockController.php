<?php

namespace App\Http\Controllers;

use App\Models\HenStock;
use App\Models\Branch;
use Illuminate\Http\Request;

class HenStockController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->hasRole('admin')) {
            $henStocks = HenStock::with('branch')->get();
        } else {
            $henStocks = HenStock::where('branch_id', $user->branch_id)->get();
        }

        return view('henstocks.index', compact('henStocks'));
    }

    public function create()
    {
        $branches = auth()->user()->hasRole('admin') ? Branch::all() : Branch::where('id', auth()->user()->branch_id)->get();
        return view('henstocks.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'breed' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'age_weeks' => 'required|integer|min:0',
            'branch_id' => 'required|exists:branches,id',
            'mortality' => 'nullable|integer|min:0',
        ]);

        HenStock::create($request->all());

        return redirect()->route('henstocks.index')->with('success', 'Hen stock recorded successfully.');
    }
}
