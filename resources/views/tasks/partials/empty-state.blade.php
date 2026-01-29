<div class="rounded-2xl border-2 border-dashed border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50 p-12 text-center shadow-sm">
    <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-indigo-100 to-cyan-100 dark:from-indigo-900/50 dark:to-cyan-900/50 flex items-center justify-center mb-5">
        <svg class="w-10 h-10 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
    </div>
    <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Nog geen taken</h2>
    <p class="text-slate-500 dark:text-slate-400 text-sm mb-6 max-w-sm mx-auto">Maak je eerste taak aan en houd je werk overzichtelijk.</p>
    <a href="{{ route('tasks.create') }}" class="btn inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-indigo-500 text-white text-sm font-semibold hover:bg-indigo-600 shadow-lg shadow-indigo-500/25 transition-all">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Eerste taak aanmaken
    </a>
</div>
