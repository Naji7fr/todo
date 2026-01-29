@extends('layouts.app')

@section('title', 'Alle taken')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white tracking-tight bg-gradient-to-r from-indigo-600 to-indigo-800 dark:from-indigo-400 dark:to-indigo-600 bg-clip-text text-transparent">Mijn taken</h1>
        <p class="mt-2 text-slate-500 dark:text-slate-400 text-sm">
            {{ $tasks->count() }} {{ $tasks->count() === 1 ? 'taak' : 'taken' }}
            @if ($filter !== 'all')(gefilterd)@endif
        </p>
    </div>

    @include('tasks.partials.summary', ['stats' => $stats, 'weekSummary' => $weekSummary])
    @include('tasks.partials.stats-bar', ['stats' => $stats, 'filter' => $filter])
    @include('tasks.partials.toolbar', ['filter' => $filter, 'sort' => $sort, 'doneCount' => $stats['done']])

    @forelse ($tasks as $task)
        @include('tasks.partials.task-card', ['task' => $task])
    @empty
        @include('tasks.partials.empty-state')
    @endforelse
@endsection
