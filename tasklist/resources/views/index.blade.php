@extends('layouts.app')

{{-- Create a simple Home page template in blade.php file. --}}
@section('title')
    <h1>The list of recently edited tasks</h1>
    <a class="btn-secondary" href="{{ route('tasks.create') }}">New Task</a>
@endsection

{{-- Debug output --}}
<div style="background: #f0f0f0; padding: 10px; margin: 10px 0; border: 1px solid #ccc;">
    <strong>Debug Info:</strong><br>
    Incomplete Tasks: {{ isset($incompleteTasks) ? count($incompleteTasks) : 'N/A' }}<br>
    Completed Tasks: {{ isset($completedTasks) ? count($completedTasks) : 'N/A' }}<br>
</div>

@section('content')
    <div>
        <h3>Incomplete Tasks: {{ isset($incompleteTasks) ? count($incompleteTasks) : 'N/A' }}</h3>
        <ul>
            @forelse ($incompleteTasks as $task)
                <li>
                    <div class="task-info">
                        <h3>{{ $task->title }}</h3>
                        <p>{{ $task->description }}</p>
                        <small>Last Edited: {{ $task->updated_at->format('Y-m-d H:i:s') }}</small>
                    </div>
                    <a class="btn-primary" href="{{ route('tasks.show', ['taskId' => $task->id]) }}">View</a>
                </li>
            @empty
                <li>No incomplete tasks available.</li>
            @endforelse
        </ul>
    </div>

    <div>
        <h3>Completed Tasks: {{ isset($completedTasks) ? count($completedTasks) : 'N/A' }}</h3>
        <ul>
            @forelse ($completedTasks as $task)
                <li>
                    <div class="task-info">
                        <h3>{{ $task->title }}</h3>
                        <p>{{ $task->description }}</p>
                        <small>Last Edited: {{ $task->updated_at->format('Y-m-d H:i:s') }}</small>
                    </div>
                    <a class="btn-primary completed" href="{{ route('tasks.show', ['taskId' => $task->id]) }}">View</a>
                </li>
            @empty
                <li>No completed tasks available.</li>
            @endforelse
        </ul>
    </div>

    {{-- Country flag, just for studying purposes: --}}
    @if (request()->has('code'))
        <h2 style="display: inline-flex; gap: 1rem; align-items: center;">
            <img src="https://flagcdn.com/{{ strtolower(request('code')) }}.svg" alt="{{ strtoupper(request('code')) }} Flag"
                width="300">
            {{-- @else
        @isset($country)
        Country: {{ $country }}
        @endisset --}}
        </h2>
    @endif
@endsection
