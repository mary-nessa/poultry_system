<?php

namespace App\Exports;

use App\Models\Expense;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExpenseExport implements FromView
{
    public function __construct(private $expenses) {}

    public function view(): View
    {
        return view('exports.expenses', [
            'expenses' => $this->expenses
        ]);
    }
}
