<?php

namespace App\Http\Controllers;

use App\Models\EggCollection;
use App\Models\Branch;
use Illuminate\Http\Request;

class EggCollectionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $eggCollections = $user->hasRole('admin') ? EggCollection::with('branch')->get() : EggCollection::where('branch_id', $user->branch_id)->get();

        return view('eggcollections.index', compact('eggCollections'));
    }

    // ✅ Ensure this method exists
    public function create()
    {
        $branches = auth()->user()->hasRole('admin') ? Branch::all() : Branch::where('id', auth()->user()->branch_id)->get();
        return view('eggcollections.create', compact('branches'));
    }

    public function store(Request $request)
    {
            
        $request->validate([
            'date' => 'required|date',
            'total_collected' => 'required|integer|min:0',
            'breakages' => 'nullable|integer|min:0',
            'losses' => 'nullable|integer|min:0',
            'transferred' => 'nullable|integer|min:0',
            'branch_id' => 'required|exists:branches,id',
            'user_id' => 'required|exists:users,id',
        ]);

        EggCollection::create($request->all());

        return redirect()->route('eggcollections.index')->with('success', 'Egg collection recorded successfully.');
    }
}

