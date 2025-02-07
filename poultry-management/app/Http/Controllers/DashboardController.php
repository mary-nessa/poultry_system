<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EggSale;
use App\Models\EggCollection;
use App\Models\Expense;
use App\Models\HenStock;
use App\Models\Branch;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return $this->adminDashboard();
        } elseif ($user->hasRole('manager')) {
            return $this->managerDashboard();
        } else {
            return $this->workerDashboard();
        }
    }

    private function adminDashboard()
    {
        return view('dashboard.admin', [
            'totalBranches' => Branch::count(),
            'totalSales' => EggSale::sum('total_price'),
            'totalExpenses' => Expense::sum('amount'),
            'totalEggsCollected' => EggCollection::sum('total_collected'),
            'totalHenStock' => HenStock::sum('quantity'),
        ]);
    }

    private function managerDashboard()
    {
        $user = auth()->user();
        return view('dashboard.manager', [
            'totalSales' => EggSale::where('branch_id', $user->branch_id)->sum('total_price'),
            'totalExpenses' => Expense::where('branch_id', $user->branch_id)->sum('amount'),
            'totalEggsCollected' => EggCollection::where('branch_id', $user->branch_id)->sum('total_collected'),
            'totalHenStock' => HenStock::where('branch_id', $user->branch_id)->sum('quantity'),
        ]);
    }

    private function workerDashboard()
    {
        return view('dashboard.worker', [
            'totalEggsCollected' => EggCollection::where('user_id', auth()->id())->sum('total_collected'),
            'totalSales' => EggSale::where('user_id', auth()->id())->sum('total_price'),
        ]);
    }
}
