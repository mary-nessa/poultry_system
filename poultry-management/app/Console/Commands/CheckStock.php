<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Stock;
use App\Models\HenStock;
use App\Models\User;
use App\Notifications\LowStockAlert;
use App\Notifications\LayingCycleAlert;

class CheckStock extends Command
{
    protected $signature = 'stock:check';
    protected $description = 'Check stock levels and send alerts';

    public function handle()
    {
        // ✅ Low Stock Alerts
        $lowStocks = Stock::whereColumn('quantity', '<=', 'low_stock_threshold')->get();
        $admins = User::role('admin')->get();

        foreach ($lowStocks as $stock) {
            foreach ($admins as $admin) {
                $admin->notify(new LowStockAlert($stock));
            }
        }

        // ✅ Laying Cycle Alerts
        $hensNearingEnd = HenStock::where('age_weeks', '>=', 72)->get();
        foreach ($hensNearingEnd as $henStock) {
            foreach ($admins as $admin) {
                $admin->notify(new LayingCycleAlert($henStock));
            }
        }

        $this->info('Stock and laying cycle alerts sent.');
    }
}
