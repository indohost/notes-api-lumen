<?php

namespace Database\Factories;

use App\Models\Notes;
use App\Models\Tags;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagsFactory extends Factory
{
    protected $model = Tags::class;

    public function definition(): array
    {
    	return [
            'tag_title' => $this->faker->jobTitle,
            'nt_id'     => Notes::all()->random()->nt_id,
    	];
    }
}
