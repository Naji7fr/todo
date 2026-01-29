<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Task model: title, description, status (todo / in_progress / done), owned by User.
 */
class Task extends Model
{
    protected $fillable = ['title', 'description', 'status', 'user_id'];

    public const STATUS_TODO = 'todo';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_DONE = 'done';

    public const SORT_NEWEST = 'newest';
    public const SORT_OLDEST = 'oldest';
    public const SORT_TITLE = 'title';

    public const FILTER_ALL = 'all';

    /**
     * Status options for dropdowns: value => label.
     */
    public static function statuses(): array
    {
        return [
            self::STATUS_TODO => 'Todo',
            self::STATUS_IN_PROGRESS => 'In progress',
            self::STATUS_DONE => 'Afgerond',
        ];
    }

    public function isDone(): bool
    {
        return $this->status === self::STATUS_DONE;
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // --- Scopes ---

    public function scopeForUser(Builder $query, ?int $userId = null): Builder
    {
        return $query->where('user_id', $userId ?? auth()->id());
    }

    public function scopeFilterByStatus(Builder $query, string $filter): Builder
    {
        if ($filter !== self::FILTER_ALL && in_array($filter, [self::STATUS_TODO, self::STATUS_IN_PROGRESS, self::STATUS_DONE], true)) {
            $query->where('status', $filter);
        }
        return $query;
    }

    public function scopeApplySort(Builder $query, string $sort): Builder
    {
        return match ($sort) {
            self::SORT_OLDEST => $query->oldest(),
            self::SORT_TITLE => $query->orderBy('title'),
            default => $query->latest(),
        };
    }

    // --- Status display helpers (for views) ---

    public function getStatusBorderClass(): string
    {
        return match ($this->status) {
            self::STATUS_DONE => 'border-l-4 border-l-emerald-500',
            self::STATUS_IN_PROGRESS => 'border-l-4 border-l-sky-500',
            default => 'border-l-4 border-l-amber-500',
        };
    }

    public function getStatusLabel(): string
    {
        return self::statuses()[$this->status] ?? $this->status;
    }

    public function getStatusBadgeClass(): string
    {
        return match ($this->status) {
            self::STATUS_DONE => 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300',
            self::STATUS_IN_PROGRESS => 'bg-sky-100 dark:bg-sky-900/50 text-sky-700 dark:text-sky-300',
            default => 'bg-amber-100 dark:bg-amber-900/50 text-amber-700 dark:text-amber-300',
        };
    }
}
