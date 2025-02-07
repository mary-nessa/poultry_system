<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Branch;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
{
    $user = auth()->user();

    \Log::info('User Accessing Expenses', [
        'user_id' => $user->id,
        'user_role' => $user->getRoleNames()
    ]);

    if ($user->hasRole('admin')) {
        $expenses = Expense::with('branch')->get(); // ✅ Admins see all expenses
    } else {
        $expenses = Expense::where('branch_id', $user->branch_id)->get(); // ✅ Managers & Workers see only their branch
    }

    $branches = Branch::all(); // Fetch all branches for the modal form

    return view('expenses.index', compact('expenses', 'branches'));
}

public function create()
{
    $branches = Branch::all();
    return view('expenses.create', compact('branches'));
}


    public function store(Request $request)
    {
        // echo('I have reached hear');
        // echo($request);
        // die();
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);
        

        Expense::create($request->all());

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully.');
    }
    public function destroy(Expense $expense)
{
    if (!auth()->user()->hasRole('admin')) {
        abort(403, 'Unauthorized action.');
    }

    $expense->delete();

    return redirect()->route('expenses.index')->with('success', 'Expense deleted.');
}

public function edit(Expense $expense)
{
    $user = auth()->user();

    // ✅ Restrict Editing: Managers & Workers can only edit their branch's expenses
    if (!$user->hasRole('admin') && $user->branch_id !== $expense->branch_id) {
        abort(403, 'Unauthorized action.');
    }

    return view('expenses.edit', compact('expense'));
}

public function update(Request $request, Expense $expense)
{
    $user = auth()->user();

    // ✅ Restrict Editing: Managers & Workers can only edit their branch's expenses
    if (!$user->hasRole('admin') && $user->branch_id !== $expense->branch_id) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'category' => 'required|string|max:255',
        'amount' => 'required|numeric|min:0',
        'date' => 'required|date',
        'description' => 'nullable|string',
    ]);

    $expense->update($request->all());

    return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
}


}
