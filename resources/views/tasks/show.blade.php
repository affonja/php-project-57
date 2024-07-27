@extends('layouts.app')

@section('content')
    <h2 class="my-8 text-3xl">{{ __('View Task') }}: {{ $task->name }}
        @auth
            <a href="{{ route('tasks.edit', $task->id) }}">⚙</a>
        @endauth
    </h2>
    <p><span class="font-bold">{{ __('Name') }}: </span>{{ $task->name }}</p>
    <p><span class="font-bold">{{ __('Status') }}: </span>{{ $task->status_name }}</p>
    <p><span class="font-bold">{{ __('Description') }}: </span>{{ $task->description }}</p>
    <p><span class="font-bold">{{ __('Tags') }}: </span></p>
@endsection
