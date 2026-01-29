@props(['stats', 'weekSummary'])

<div class="mb-8 rounded-2xl border border-indigo-200 dark:border-indigo-800/50 bg-indigo-50/80 dark:bg-indigo-950/30 p-5 shadow-sm">
    <h2 class="text-lg font-semibold text-slate-900 dark:text-white mb-3">Samenvatting</h2>
    <div class="flex flex-wrap gap-8 sm:gap-10">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center">
                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['total'] }}</p>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Totaal</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-amber-100 dark:bg-amber-900/50 flex items-center justify-center">
                <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['todo'] }}</p>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Todo</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-sky-100 dark:bg-sky-900/50 flex items-center justify-center">
                <svg class="w-6 h-6 text-sky-600 dark:text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['in_progress'] }}</p>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">In progress</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center">
                <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['done'] }}</p>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Afgerond</p>
            </div>
        </div>
        <div class="flex items-center gap-3 border-l border-indigo-200 dark:border-indigo-700 pl-6">
            <div class="w-12 h-12 rounded-xl bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center">
                <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $weekSummary['created'] }} / {{ $weekSummary['completed'] }}</p>
                <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Deze week: toegevoegd / afgerond</p>
            </div>
        </div>
    </div>
</div>
