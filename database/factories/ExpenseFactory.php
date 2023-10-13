<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition()
    {
        return [
            'date_time' => fake()->dateTimeBetween(now()->subYears(2), 'now'),
            'ammount' => fake()->randomNumber(5, false),
        ];
    }
}
