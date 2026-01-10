@extends('layouts.app')

@section('title')
    <h1>
        <span style="margin-right: 1rem;">
            @if ($task->completed)
                ✅
            @else
                🔄
            @endif
        </span>
        {{ $task->title }}
    </h1>
@endsection

@section('content')
    {{-- Comeback button --}}
    <a class="btn-terciary" href="{{ route('tasks.index') }}">Back to task list</a>

    <p><strong>Description:</strong> {{ $task->description }}</p>

    @if ($task->long_description)
        <p><strong>Long Description:</strong> {{ $task->long_description }}</p>
    @endif

    <p><strong>Last Edited:</strong> {{ $task->updated_at->format('Y-m-d H:i:s') }}</p>
    <p></p><strong>Created At:</strong> {{ $task->created_at->format('Y-m-d H:i:s') }}</p>
@endsection
