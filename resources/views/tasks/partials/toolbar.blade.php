@props(['filter', 'sort', 'doneCount' => 0])

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div class="flex flex-wrap items-center gap-2">
        <span class="text-sm font-medium text-slate-500 dark:text-slate-400 mr-1">Filter:</span>
        <a href="{{ route('tasks.index', ['filter' => 'all'] + request()->only('sort')) }}"
           class="px-3 py-1.5 rounded-xl text-sm font-medium transition-colors {{ $filter === 'all' ? 'bg-indigo-500 text-white shadow-md' : 'bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-300 dark:hover:bg-slate-600' }}">Alles</a>
        <a href="{{ route('tasks.index', ['filter' => 'todo'] + request()->only('sort')) }}"
           class="px-3 py-1.5 rounded-xl text-sm font-medium transition-colors {{ $filter === 'todo' ? 'bg-amber-500 text-white shadow-md' : 'bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-300 dark:hover:bg-slate-600' }}">Todo</a>
        <a href="{{ route('tasks.index', ['filter' => 'in_progress'] + request()->only('sort')) }}"
           class="px-3 py-1.5 rounded-xl text-sm font-medium transition-colors {{ $filter === 'in_progress' ? 'bg-sky-500 text-white shadow-md' : 'bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-300 dark:hover:bg-slate-600' }}">In progress</a>
        <a href="{{ route('tasks.index', ['filter' => 'done'] + request()->only('sort')) }}"
           class="px-3 py-1.5 rounded-xl text-sm font-medium transition-colors {{ $filter === 'done' ? 'bg-emerald-500 text-white shadow-md' : 'bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-300 dark:hover:bg-slate-600' }}">Afgerond</a>
    </div>
    <div class="flex flex-wrap items-center gap-2">
        <form action="{{ route('tasks.index') }}" method="GET" class="flex items-center gap-2">
            @if (request('filter'))
                <input type="hidden" name="filter" value="{{ request('filter') }}">
            @endif
            <label for="sort" class="text-sm font-medium text-slate-500 dark:text-slate-400">Sorteren:</label>
            <select name="sort" id="sort" onchange="this.form.submit()"
                class="min-w-[10rem] rounded-xl border border-slate-200 dark:border-slate-500 bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-100 text-sm font-medium shadow-sm pl-3 pr-9 py-2 min-h-10 appearance-none cursor-pointer outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent hover:border-slate-300 dark:hover:border-slate-400"
                style="background-image: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E&quot;); background-repeat: no-repeat; background-position: right 0.5rem center; background-size: 1.25rem 1.25rem;">
                <option value="newest" {{ $sort === 'newest' ? 'selected' : '' }}>Nieuwste eerst</option>
                <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Oudste eerst</option>
                <option value="title" {{ $sort === 'title' ? 'selected' : '' }}>Naam A–Z</option>
            </select>
        </form>
        @if ($doneCount > 0)
            <form action="{{ route('tasks.clear-completed') }}" method="POST" class="inline" onsubmit="return confirm('Alle afgeronde taken verwijderen?');">
                @csrf
                <button type="submit" class="px-3 py-2 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-950/30 border border-red-200 dark:border-red-800 transition-colors">
                    Afgeronde wissen
                </button>
            </form>
        @endif
    </div>
</div>
