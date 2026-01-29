@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <div class="mb-6">
        @include('tasks.partials.back-link', ['href' => route('tasks.index'), 'label' => 'Terug naar overzicht'])
    </div>

    <article class="task-card rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50 overflow-hidden shadow-sm {{ $task->getStatusBorderClass() }}">
        <div class="p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white tracking-tight {{ $task->status === 'done' ? 'line-through text-slate-500 dark:text-slate-400' : '' }}">
                        {{ $task->title }}
                    </h1>
                    <div class="mt-2 flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-sm font-medium {{ $task->getStatusBadgeClass() }}">{{ $task->getStatusLabel() }}</span>
                        <span class="text-sm text-slate-400 dark:text-slate-500">Laatst bijgewerkt {{ $task->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <div class="prose prose-slate max-w-none">
                @if ($task->description)
                    <p class="text-slate-600 leading-relaxed whitespace-pre-wrap">{{ $task->description }}</p>
                @else
                    <p class="text-slate-400 italic">Geen beschrijving toegevoegd.</p>
                @endif
            </div>

            <div class="mt-8 pt-6 border-t border-slate-200 dark:border-slate-700 flex flex-wrap items-center gap-3">
                <a href="{{ route('tasks.edit', $task) }}" class="btn inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-indigo-500 text-white text-sm font-semibold hover:bg-indigo-600 shadow-lg shadow-indigo-500/25">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11 15H9v-2l8.586-8.586z"/></svg>
                    Bewerken
                </a>
                <form action="{{ route('tasks.set-status', $task) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <select name="status" onchange="this.form.submit()"
                        class="rounded-xl border border-slate-200 dark:border-slate-500 bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-100 text-sm font-medium shadow-sm pl-2 pr-8 py-2 min-h-9 appearance-none cursor-pointer outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent hover:border-slate-300 dark:hover:border-slate-400"
                        style="background-image: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E&quot;); background-repeat: no-repeat; background-position: right 0.5rem center; background-size: 1.25rem 1.25rem;">
                        @foreach (\App\Models\Task::statuses() as $value => $label)
                            <option value="{{ $value }}" {{ $task->status === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </form>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Taak definitief verwijderen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-red-600 text-sm font-medium hover:bg-red-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Verwijderen
                    </button>
                </form>
            </div>
        </div>
    </article>
@endsection
