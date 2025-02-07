@extends('layouts.app')

@section('content')
<div class="p-5">
    <h1 class="text-2xl font-bold mb-4">User Management</h1>

    @if(session('success'))
        <p class="text-green-500 bg-green-100 p-3 rounded-md">{{ session('success') }}</p>
    @endif

    <x-user-list :users="$users" />
</div>
@endsection
