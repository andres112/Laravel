@extends('layouts.app')

@section('title')
    <h1>Create New Task</h1>
@endsection

@section('content')
    <form method="POST" action="{{ route('tasks.store') }}"></form>
        {{-- CSRF mandatory token for security --}}
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <div>
            <label for="completed">Completed:</label>
            <input type="checkbox" id="completed" name="completed">
        </div>
        <button type="submit" class="btn-primary">Create Task</button>
    </form>
@endsection
