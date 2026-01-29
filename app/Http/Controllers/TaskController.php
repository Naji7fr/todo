<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetTaskStatusRequest;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * CRUD + filter/sort/status for authenticated user's tasks.
 */
class TaskController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->get('filter', Task::FILTER_ALL);
        $sort = $request->get('sort', Task::SORT_NEWEST);

        $tasks = Task::query()
            ->forUser()
            ->filterByStatus($filter)
            ->applySort($sort)
            ->get();

        $stats = $this->getStats();
        $weekSummary = $this->getWeekSummary();

        return view('tasks.index', compact('tasks', 'stats', 'filter', 'sort', 'weekSummary'));
    }

    public function create(): View
    {
        return view('tasks.create');
    }

    public function store(TaskStoreRequest $request): RedirectResponse
    {
        Task::create([
            ...$request->validated(),
            'status' => Task::STATUS_TODO,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Taak aangemaakt!');
    }

    public function show(Task $task): View
    {
        $this->authorize('view', $task);

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task): View
    {
        $this->authorize('update', $task);

        return view('tasks.edit', compact('task'));
    }

    public function update(TaskUpdateRequest $request, Task $task): RedirectResponse
    {
        $task->update($request->validated());

        return redirect()->route('tasks.index')->with('success', 'Taak bijgewerkt!');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Taak verwijderd.');
    }

    public function setStatus(SetTaskStatusRequest $request, Task $task): RedirectResponse
    {
        $task->update(['status' => $request->validated('status')]);
        $label = $task->getStatusLabel();

        return redirect()->back()->with('success', "Status gezet op {$label}.");
    }

    public function clearCompleted(): RedirectResponse
    {
        $count = Task::forUser()->where('status', Task::STATUS_DONE)->delete();
        $message = $count > 0
            ? "{$count} afgeronde taken verwijderd."
            : 'Geen afgeronde taken om te verwijderen.';

        return redirect()->route('tasks.index')->with('success', $message);
    }

    private function getStats(): array
    {
        $base = Task::forUser();

        return [
            'total' => (clone $base)->count(),
            'todo' => (clone $base)->where('status', Task::STATUS_TODO)->count(),
            'in_progress' => (clone $base)->where('status', Task::STATUS_IN_PROGRESS)->count(),
            'done' => (clone $base)->where('status', Task::STATUS_DONE)->count(),
        ];
    }

    private function getWeekSummary(): array
    {
        $base = Task::forUser();
        $weekStart = now()->startOfWeek();
        $weekEnd = now()->endOfWeek();

        return [
            'created' => (clone $base)->whereBetween('created_at', [$weekStart, $weekEnd])->count(),
            'completed' => (clone $base)
                ->where('status', Task::STATUS_DONE)
                ->whereBetween('updated_at', [$weekStart, $weekEnd])
                ->count(),
        ];
    }
}
