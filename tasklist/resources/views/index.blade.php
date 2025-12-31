{{-- Create a simple Home page template in blade.php file. --}}
<h1>Welcome to the Task List</h1>

{{-- Debug output --}}
<div style="background: #f0f0f0; padding: 10px; margin: 10px 0; border: 1px solid #ccc;">
    <strong>Debug Info:</strong><br>
    Tasks variable exists: {{ isset($tasks) ? 'YES' : 'NO' }}<br>
    @if(isset($tasks))
        Tasks count: {{ count($tasks) }}<br>
        Tasks type: {{ gettype($tasks) }}<br>
    @endif
</div>

<div>
    <h3>Recently Edited Tasks:</h3>
    <ul>
        @forelse ($tasks as $task)
            <li>
                <strong> <a href="{{ route('tasks.show', $task->id) }}">{{ $task->title }}</a></strong> - Last Edited: {{ $task->updated_at->format('Y-m-d H:i:s') }}
            </li>
        @empty
            <li>No tasks available.</li>
        @endforelse
    </ul>
</div>

{{-- <h2 style="display: inline-flex; gap: 1rem; align-items: center;">
    @if(request()->has('code'))
        <img src="https://flagcdn.com/{{ strtolower(request('code')) }}.svg" alt="{{ strtoupper(request('code')) }} Flag" width="300">
    @else
        @isset($country)
        Country: {{ $country }}
        @endisset
    @endif
</h2> --}}


