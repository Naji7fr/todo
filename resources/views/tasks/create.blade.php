@extends('layouts.app')

@section('title', 'Nieuwe taak')

@section('content')
    <div class="mb-8">
        @include('tasks.partials.back-link', ['href' => route('tasks.index'), 'label' => 'Terug naar overzicht'])
        <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white tracking-tight">Nieuwe taak</h1>
        <p class="mt-1 text-slate-500 dark:text-slate-400 text-sm">Voeg een taak toe aan je lijst.</p>
    </div>

    <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50 p-6 sm:p-8 shadow-sm">
        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label for="title" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Titel <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required placeholder="Bijv. Documentatie afronden"
                    class="input-field w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 transition-shadow">
            </div>
            <div>
                <label for="description" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Beschrijving</label>
                <textarea name="description" id="description" rows="4" placeholder="Optioneel: extra toelichting..."
                    class="input-field w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white placeholder-slate-400 resize-y transition-shadow">{{ old('description') }}</textarea>
            </div>
            <div class="flex flex-wrap items-center gap-3 pt-2">
                <button type="submit" class="btn inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-500 text-white text-sm font-semibold hover:bg-indigo-600 shadow-lg shadow-indigo-500/25">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Taak opslaan
                </button>
                <a href="{{ route('tasks.index') }}" class="btn inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-600 text-slate-700 dark:text-slate-300 text-sm font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    Annuleren
                </a>
            </div>
        </form>
    </div>
@endsection
