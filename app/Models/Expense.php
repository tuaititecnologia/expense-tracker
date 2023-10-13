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

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

}
