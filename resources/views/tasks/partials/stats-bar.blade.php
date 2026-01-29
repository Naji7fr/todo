@props(['stats', 'filter'])

<div class="grid grid-cols-2 sm:grid-cols-4 gap-3 sm:gap-4 mb-8">
    <a href="{{ route('tasks.index', ['filter' => 'all'] + request()->only('sort')) }}"
       class="stat-card rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50 p-4 shadow-sm hover:shadow-md {{ $filter === 'all' ? 'ring-2 ring-indigo-500' : '' }}">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center">
                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['total'] }}</p>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Totaal</p>
            </div>
        </div>
    </a>
    <a href="{{ route('tasks.index', ['filter' => 'todo'] + request()->only('sort')) }}"
       class="stat-card rounded-2xl border border-amber-200 dark:border-amber-800/50 bg-amber-50/80 dark:bg-amber-950/30 p-4 shadow-sm hover:shadow-md {{ $filter === 'todo' ? 'ring-2 ring-amber-500' : '' }}">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900/50 flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-amber-800 dark:text-amber-200">{{ $stats['todo'] }}</p>
                <p class="text-xs font-medium text-amber-600 dark:text-amber-400 uppercase tracking-wider">Todo</p>
            </div>
        </div>
    </a>
    <a href="{{ route('tasks.index', ['filter' => 'in_progress'] + request()->only('sort')) }}"
       class="stat-card rounded-2xl border border-sky-200 dark:border-sky-800/50 bg-sky-50/80 dark:bg-sky-950/30 p-4 shadow-sm hover:shadow-md {{ $filter === 'in_progress' ? 'ring-2 ring-sky-500' : '' }}">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-sky-100 dark:bg-sky-900/50 flex items-center justify-center">
                <svg class="w-5 h-5 text-sky-600 dark:text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-sky-800 dark:text-sky-200">{{ $stats['in_progress'] }}</p>
                <p class="text-xs font-medium text-sky-600 dark:text-sky-400 uppercase tracking-wider">In progress</p>
            </div>
        </div>
    </a>
    <a href="{{ route('tasks.index', ['filter' => 'done'] + request()->only('sort')) }}"
       class="stat-card rounded-2xl border border-emerald-200 dark:border-emerald-800/50 bg-emerald-50/80 dark:bg-emerald-950/30 p-4 shadow-sm hover:shadow-md {{ $filter === 'done' ? 'ring-2 ring-emerald-500' : '' }}">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center">
                <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-emerald-800 dark:text-emerald-200">{{ $stats['done'] }}</p>
                <p class="text-xs font-medium text-emerald-600 dark:text-emerald-400 uppercase tracking-wider">Afgerond</p>
            </div>
        </div>
    </a>
</div>
