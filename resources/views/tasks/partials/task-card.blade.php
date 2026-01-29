@props(['task'])

<article class="task-card group mb-4 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/50 p-5 shadow-sm {{ $task->getStatusBorderClass() }}">
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
        <div class="flex-1 min-w-0">
            <a href="{{ route('tasks.show', $task) }}" class="block">
                <h2 class="font-semibold text-slate-900 dark:text-white text-lg leading-snug {{ $task->status === 'done' ? 'line-through text-slate-500 dark:text-slate-400' : '' }}">
                    {{ $task->title }}
                </h2>
                @if ($task->description)
                    <p class="mt-1.5 text-sm text-slate-500 dark:text-slate-400 line-clamp-2">{{ $task->description }}</p>
                @endif
            </a>
            <div class="mt-3 flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium {{ $task->getStatusBadgeClass() }}">
                    {{ $task->getStatusLabel() }}
                </span>
                <span class="text-xs text-slate-400 dark:text-slate-500">{{ $task->updated_at->diffForHumans() }}</span>
            </div>
        </div>
        <div class="flex items-center gap-2 shrink-0 flex-wrap">
            <form action="{{ route('tasks.set-status', $task) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <select name="status" onchange="this.form.submit()"
                    class="rounded-xl border border-slate-200 dark:border-slate-500 bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-100 text-sm font-medium shadow-sm pl-2 pr-8 py-1.5 min-h-8 appearance-none cursor-pointer outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent hover:border-slate-300 dark:hover:border-slate-400"
                    style="background-image: url(&quot;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2394a3b8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E&quot;); background-repeat: no-repeat; background-position: right 0.375rem center; background-size: 1rem 1rem;">
                    @foreach (\App\Models\Task::statuses() as $value => $label)
                        <option value="{{ $value }}" {{ $task->status === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </form>
            <a href="{{ route('tasks.edit', $task) }}" class="btn inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-white">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11 15H9v-2l8.586-8.586z"/></svg>
                Bewerken
            </a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline" onsubmit="return confirm('Taak definitief verwijderen?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-sm font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-950/30">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Verwijderen
                </button>
            </form>
        </div>
    </div>
</article>
