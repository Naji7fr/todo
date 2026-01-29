@extends('layouts.app')

@section('title', 'Taak bewerken')

@section('content')
    <div class="mb-8">
        @include('tasks.partials.back-link', ['href' => route('tasks.show', $task), 'label' => 'Terug naar taak'])
        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Taak bewerken</h1>
        <p class="mt-1 text-slate-500 dark:text-slate-400 text-sm">{{ $task->title }}</p>
    </div>

    <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50 p-6 sm:p-8 shadow-sm">
        <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Titel <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required placeholder="Bijv. Documentatie afronden"
                    class="input-field w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 transition-shadow">
            </div>
            <div>
                <label for="description" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Beschrijving</label>
                <textarea name="description" id="description" rows="4" placeholder="Optioneel: extra toelichting..."
                    class="input-field w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 resize-y transition-shadow">{{ old('description', $task->description) }}</textarea>
            </div>
            <div>
                <label for="status" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Status</label>
                <select name="status" id="status"
                    class="w-full max-w-xs rounded-xl border border-slate-200 dark:border-slate-500 bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-100 text-sm font-medium shadow-sm pl-3 pr-9 py-3 min-h-10 appearance-none cursor-pointer outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent hover:border-slate-300 dark:hover:border-slate-400"
                    style="background-image: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E&quot;); background-repeat: no-repeat; background-position: right 0.5rem center; background-size: 1.25rem 1.25rem;">
                    @foreach (\App\Models\Task::statuses() as $value => $label)
                        <option value="{{ $value }}" {{ old('status', $task->status) === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-wrap items-center gap-3 pt-2">
                <button type="submit" class="btn inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-500 text-white text-sm font-semibold hover:bg-indigo-600 shadow-lg shadow-indigo-500/25">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Wijzigingen opslaan
                </button>
                <a href="{{ route('tasks.show', $task) }}" class="btn inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    Annuleren
                </a>
            </div>
        </form>
    </div>
@endsection
