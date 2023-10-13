<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use HasFactory;

    public $guarded = [];

    protected $casts = [
        'ammount' => MoneyCast::class,
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSumByMonth($query)
    {
        return $query->selectRaw("DATE_FORMAT(date_time, '%Y-%m') as month, SUM(ammount) as total")
            ->where('date_time', '>=', now()->subMonths(12)) // Filter for the last 12 months
            ->groupByRaw("DATE_FORMAT(date_time, '%Y-%m')")
            ->orderByRaw("DATE_FORMAT(date_time, '%Y-%m') ASC");
    }
}
