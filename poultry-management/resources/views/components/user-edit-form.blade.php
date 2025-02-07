<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <!-- ✅ Select Role -->
    <label class="block mb-2 font-semibold">Select Role:</label>
    <select name="role" class="border p-2 rounded w-full" required>
        @foreach($roles as $role)
            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>

    <!-- ✅ Select Branch -->
    <label class="block mt-4 mb-2 font-semibold">Assign Branch:</label>
    <select name="branch_id" class="border p-2 rounded w-full">
        <option value="">Not Assigned</option>
        @foreach($branches as $branch)
            <option value="{{ $branch->id }}" {{ $user->branch_id == $branch->id ? 'selected' : '' }}>
                {{ $branch->name }}
            </option>
        @endforeach
    </select>

    <div class="mt-4">
        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-700">
            Update User
        </button>
        <a href="{{ route('users.index') }}" class="ml-2 px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-700">
            Cancel
        </a>
    </div>
</form>
