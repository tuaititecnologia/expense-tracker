<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function scopeOrderByMostUsed($query)
    {
        return $query
            ->select('categories.id', 'categories.name')
            ->selectRaw('COUNT(expenses.id) as expense_count')
            ->leftJoin('expenses', 'categories.id', '=', 'expenses.category_id')
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('expense_count');
    }
}
