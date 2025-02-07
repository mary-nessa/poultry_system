
<div id="sidebarMenu" class="h-screen w-64 bg-gray-800 text-white space-y-4">
    <div class="p-4 text-xl font-bold border-b border-gray-700">
        Poultry Management
    </div>

    <ul class="mt-4 space-y-2">
        <li><a href="{{ route('dashboard') }}" class="block p-3 hover:bg-gray-700"><i class="fas fa-tachometer-alt mr-2"></i>Dashboard</a></li>

        @if(auth()->user()->hasRole('admin'))
            <li><a href="{{ route('branches.index') }}" class="block p-3 hover:bg-gray-700"><i class="fas fa-building mr-2"></i>Branches</a></li>
            <li><a href="{{ route('expenses.index') }}" class="block p-3 hover:bg-gray-700"><i class="fas fa-credit-card mr-2"></i>Expenses</a></li>
            <li><a href="{{ route('expense-reports.index') }}" class="block p-3 hover:bg-gray-700"><i class="fas fa-file-alt mr-2"></i>Reports</a></li>
            <li><a href="{{ route('eggsales.index') }}" class="block p-3 hover:bg-gray-700"><i class="fas fa-dollar-sign mr-2"></i>Sales</a></li>
            
        @endif

        @if(auth()->user()->hasRole('manager'))
            <li><a href="{{ route('expenses.index') }}" class="block p-3 hover:bg-gray-700"><i class="fas fa-credit-card mr-2"></i>Expenses</a></li>
            <li><a href="{{ route('henstocks.index') }}" class="block p-3 hover:bg-gray-700"><i class="fas fa-cogs mr-2"></i>Hen Stock</a></li>
            <li><a href="{{ route('eggcollections.index') }}" class="block p-3 hover:bg-gray-700"><i class="fas fa-egg mr-2"></i>Egg Collection</a></li>
            <li><a href="{{ route('eggsales.index') }}" class="block p-3 hover:bg-gray-700"><i class="fas fa-dollar-sign mr-2"></i>Sales</a></li>
        @endif

        @if(auth()->user()->hasRole('admin'))
        <li><a href="{{ route('users.index') }}" class="block p-3 hover:bg-gray-700">
            <i class="fas fa-users mr-2"></i>Manage Users
        </a></li>
    @endif
    


        @if(auth()->user()->hasRole('worker'))
            <li><a href="{{ route('eggcollections.index') }}" class="block p-3 hover:bg-gray-700"><i class="fas fa-egg mr-2"></i>Egg Collection</a></li>
            <li><a href="{{ route('eggsales.index') }}" class="block p-3 hover:bg-gray-700"><i class="fas fa-dollar-sign mr-2"></i>Sales</a></li>
        @endif

        <li>
            <form method="POST" action="{{ route('logout') }}" class="p-3 hover:bg-red-700">
                @csrf
                <button type="submit" class="w-full text-left"><i class="fas fa-sign-out-alt mr-2"></i>Logout</button>
            </form>
        </li>
    </ul>
</div>

