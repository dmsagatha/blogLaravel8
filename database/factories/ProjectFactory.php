<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
  protected $model = Project::class;
  
  public function definition()
  {
    return [
      'name'  => $this->faker->company,
      'description' => $this->faker->paragraph(3),
      'user_id' => User::all()->random()->id,
      'created_at' => now()
    ];
  }
}
