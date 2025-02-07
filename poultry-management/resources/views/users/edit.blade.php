@extends('layouts.app')

@section('content')
<div class="p-5">
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>

    @include('components.user-edit-form', ['user' => $user, 'roles' => $roles, 'branches' => $branches])

    <a href="{{ route('users.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">Back to Users</a>
</div>
@endsection
