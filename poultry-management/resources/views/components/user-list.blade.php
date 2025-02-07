<div class="overflow-x-auto">
    <table class="w-full border border-gray-300 rounded-lg overflow-hidden shadow-md">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Email</th>
                <th class="px-4 py-3 text-left">Role</th>
                <th class="px-4 py-3 text-left">Branch</th> <!-- ✅ Added Branch Column -->
                <th class="px-4 py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-300">
            @foreach ($users as $user)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-3">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    <td class="px-4 py-3">{{ $user->roles->pluck('name')->join(', ') }}</td>
                    <td class="px-4 py-3">{{ $user->branch->name ?? 'Not Assigned' }}</td> <!-- ✅ Display Branch -->
                    <td class="px-4 py-3 text-center">
                        <a href="{{ route('users.edit', $user->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-700">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
