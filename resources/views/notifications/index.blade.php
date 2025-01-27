@extends('layouts.app')

@section('title', 'Notifications')

@section('content')
<div class="container">
    <h1>Notifications</h1>
    <ul>
        @forelse($notifications as $notification)
            <li>
                <p>{{ $notification->message }}</p>
                <p>{{ $notification->created_at->diffForHumans() }}</p>
            </li>
        @empty
            <p>No new notifications.</p>
        @endforelse
    </ul>
</div>
@endsection
