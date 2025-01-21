<?php

namespace Database\Factories;

use App\Models\ErrorItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class ErrorItemFactory extends Factory
{
    protected $model = ErrorItem::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
