<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Branch;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExpenseExport;

class ExpenseReportController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        
        $branches = $user->hasRole('admin') ? Branch::all() : Branch::where('id', $user->branch_id)->get();

        $expenses = $this->filterExpenses($request);

        $totalExpense = $expenses->sum('amount');

        return view('reports.expenses', compact('expenses', 'branches', 'totalExpense'));
    }

    public function exportExcel(Request $request)
    {
        $expenses = $this->filterExpenses($request);
        return Excel::download(new ExpenseExport($expenses), 'expenses.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $expenses = $this->filterExpenses($request);
        $pdf = Pdf::loadView('exports.expenses', compact('expenses'));
        return $pdf->download('expenses.pdf');
    }

    private function filterExpenses(Request $request)
    {
        $query = Expense::query();
        
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }
        
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        if ($request->filled('branch_id')) {
            $query->where('branch_id', $request->branch_id);
        }

        return $query->get();
    }
    public function showGraphs(Request $request)
    {
        $expenses = $this->filterExpenses($request);
    
        $chartData = [
            'labels' => $expenses->pluck('category'),
            'amounts' => $expenses->pluck('amount'),
        ];
    
        return view('reports.expense-graphs', compact('chartData'));
    }
    

}
