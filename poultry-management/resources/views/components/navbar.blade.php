<nav class="bg-gray-800 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-xl font-bold">Poultry Management</a>

        <ul class="flex space-x-4">
            <li><a href="{{ route('dashboard') }}" class="hover:text-gray-300">Dashboard</a></li>

            @if(auth()->user()->hasRole('admin'))
                <li><a href="{{ route('branches.index') }}" class="hover:text-gray-300">Branches</a></li>
                <li><a href="{{ route('expenses.index') }}" class="hover:text-gray-300">Expenses</a></li>
                <li><a href="{{ route('expense-reports.index') }}" class="hover:text-gray-300">Reports</a></li>
            @endif

            @if(auth()->user()->hasRole('manager'))
                <li><a href="{{ route('expenses.index') }}" class="hover:text-gray-300">Expenses</a></li>
                <li><a href="{{ route('henstocks.index') }}" class="hover:text-gray-300">Hen Stock</a></li>
                <li><a href="{{ route('eggcollections.index') }}" class="hover:text-gray-300">Egg Collection</a></li>
            @endif

            @if(auth()->user()->hasRole('worker'))
                <li><a href="{{ route('eggcollections.index') }}" class="hover:text-gray-300">Egg Collection</a></li>
                <li><a href="{{ route('eggsales.index') }}" class="hover:text-gray-300">Sales</a></li>
            @endif

            <!-- Logout -->
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="hover:text-red-400">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
