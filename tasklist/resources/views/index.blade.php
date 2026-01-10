@extends('layouts.app')

{{-- Create a simple Home page template in blade.php file. --}}
@section('title', 'The list of recently edited tasks')

{{-- Debug output --}}
<div style="background: #f0f0f0; padding: 10px; margin: 10px 0; border: 1px solid #ccc;">
    <strong>Debug Info:</strong><br>
    Tasks variable exists: {{ isset($tasks) ? 'YES' : 'NO' }}<br>
    @if (isset($tasks))
        Tasks count: {{ count($tasks) }}<br>
        Tasks type: {{ gettype($tasks) }}<br>
    @endif
</div>

@section('content')
    <div>
        <h3>Recently Edited Tasks:</h3>
        <ul>
            @forelse ($tasks as $task)
                <li>
                    <div class="task-info">
                        <h3>{{ $task->title }}</h3>
                        <p>{{ $task->description }}</p>
                        <small>Last Edited: {{ $task->updated_at->format('Y-m-d H:i:s') }}</small>
                    </div>
                    <a class="btn-task" href="{{ route('tasks.show', ['taskId' => $task->id]) }}">View</a>
                </li>
            @empty
                <li>No tasks available.</li>
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
