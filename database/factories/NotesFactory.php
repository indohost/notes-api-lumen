<?php

namespace Database\Factories;

use App\Models\Notes;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotesFactory extends Factory
{
    protected $model = Notes::class;

    public function definition(): array
    {
    	return [
            'nt_title'  => $this->faker->sentence,
            'nt_body'  => $this->faker->paragraph,
            'user_id'  => User::all()->random()->id,
    	];
    }
}
