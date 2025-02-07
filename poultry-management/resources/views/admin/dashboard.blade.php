@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold">Admin Dashboard</h1>

    <div class="mt-4">
        <a href="{{ route('branches.index') }}" class="text-blue-500">Manage Branches</a>
    </div>
    @if(auth()->user()->notifications->count() > 0)
    <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
        <strong>Alerts:</strong>
        <ul>
            @foreach(auth()->user()->notifications as $notification)
                <li>{{ $notification->data['message'] }}</li>
            @endforeach
        </ul>
    </div>
@endif


@endsection
